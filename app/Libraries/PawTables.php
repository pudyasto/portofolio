<?php

namespace App\Libraries;

class PawTables
{
    //put your code here
    protected $db;
    protected $aColumns = array();
    protected $sIndexColumn;
    protected $sLimit;
    protected $sTable;
    protected $sOrder;
    protected $sWhere;
    protected $sQuery;
    protected $rResult;
    protected $iTotalDisplayRecords;
    protected $iTotalRecords;
    protected $iDetail;

    public function __construct()
    {
    }

    public function output($get, $column,  $table, $index = null, $subtable = null, $table_key = null, $database = null)
    {
        $this->db =  \Config\Database::connect($database);
        $this->aColumns = $column;
        $this->sTable = $table;
        if ($index) {
            $this->sIndexColumn = $index;
        } else {
            $this->sIndexColumn = $this->aColumns[0];
        }
        $this->_set_limit($get);
        $this->_set_order($get);
        $this->_set_where($get);
        $this->_set_total_records();
        $this->_set_query();

        if (!isset($get['sEcho'])) {
            return "Kesalahan, ID Key tidak ada!";
        }
        if (intval($get['sEcho']) > 0) {
            $output = array(
                "sEcho" => intval($get['sEcho']),
                "iTotalRecords" => $this->iTotalRecords,
                "iTotalDisplayRecords" => $this->iTotalDisplayRecords,
                "aaData" => array(),
            );
            if ($subtable !== null && $table_key !== null) {
                $this->iDetail = $this->_sub_table($subtable);
            }
            foreach ($this->rResult as $aRow) {
                $row = array();
                foreach ($aRow as $key => $val) {
                    if (is_numeric($val) && substr($val, 0, 1) !== "0") {
                        $row[$key] = (float) $val; // $val; //
                    } else {
                        $row[$key] = $val;
                    }
                }
                if ($this->iDetail) {
                    $row['detail'] = array();
                    foreach ($this->iDetail as $v_detail) {
                        if ($row[$table_key] == $v_detail[$table_key]) {
                            $row['detail'][] = $v_detail;
                        }
                    }
                }
                $output['aaData'][] = $row;
            }
        } else {
            $output = array(
                "sEcho" => intval($get['sEcho']),
                "iTotalRecords" => 0,
                "iTotalDisplayRecords" => 0,
                "aaData" => array(),
            );
        }
        $output[csrf_token()] = csrf_hash();
        return json_encode($output);
    }

    private function _set_limit($get)
    {
        if (!empty($get['iDisplayLength']) && $get['iDisplayLength'] != '-1') {
            $this->sLimit = " LIMIT " . $get['iDisplayLength'];
        }

        if (isset($get['iDisplayStart']) && $get['iDisplayLength'] != '-1') {
            if (intval($get['iDisplayStart']) > 0) {
                $this->sLimit = " LIMIT " . intval($get['iDisplayLength']) . " OFFSET " .
                    intval($get['iDisplayStart']);
            }
        }
    }

    private function _set_order($get)
    {
        if (isset($get['iSortCol_0'])) {
            $this->sOrder = " ORDER BY  ";
            for ($i = 0; $i < intval($get['iSortingCols']); $i++) {
                if ($get['bSortable_' . intval($get['iSortCol_' . $i])] == "true") {
                    $this->sOrder .= "" . $this->aColumns[intval($get['iSortCol_' . $i])] . " " .
                        ($get['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $this->sOrder = substr_replace($this->sOrder, "", -2);
            if ($this->sOrder == " ORDER BY") {
                $this->sOrder = "";
            }
        }
    }

    private function _set_where($get)
    {
        if (isset($get['sSearch']) && $get['sSearch'] != "") {
            $this->sWhere = " Where (";
            for ($i = 0; $i < count($this->aColumns); $i++) {
                $this->sWhere .= "lower(" . $this->aColumns[$i] . ") LIKE '%"
                    . strtolower(addslashes($get['sSearch'])) . "%' OR ";
            }
            $this->sWhere = substr_replace($this->sWhere, "", -3);
            $this->sWhere .= ')';
        }

        for ($i = 0; $i < count($this->aColumns); $i++) {
            if (isset($get['bSearchable_' . $i]) && $get['bSearchable_' . $i] == "true" && $get['sSearch_' . $i] != '') {
                if ($this->sWhere == "") {
                    $this->sWhere = " WHERE ";
                } else {
                    $this->sWhere .= " AND ";
                }
                $this->sWhere .= "lower(" . $this->aColumns[$i] . ")  LIKE '%"
                    . strtolower(addslashes($get['sSearch_' . $i])) . "%' ";
            }
        }
    }

    private function _set_total_records()
    {
        $q = "SELECT COUNT("
            . $this->sIndexColumn
            . ") jml "
            . " FROM "
            . $this->sTable
            . $this->sWhere;
        $resCount = $this->db->query($q)->getRow();
        $this->iTotalDisplayRecords  = $resCount->jml;
    }

    private function _set_query()
    {
        $this->sQuery = "SELECT "
            . str_replace(" , ", " ", implode(", ", $this->aColumns))
            . " FROM "
            . $this->sTable
            . $this->sWhere
            . $this->sOrder
            . $this->sLimit;
        // echo $this->sQuery;

        $resSelect = $this->db->query($this->sQuery)->getResultArray();
        $this->rResult = $resSelect;
        $this->iTotalRecords = count($resSelect);
    }

    private function _sub_table($query)
    {
        $output = array();
        $res = $this->db->query($query)->getResultArray();
        foreach ($res as $aRow) {
            foreach ($aRow as $key => $value) {
                if (is_numeric($value)) {
                    $aRow[$key] = (float) $value;
                } else {
                    $aRow[$key] = $value;
                }
            }
            $output[] = $aRow;
        }
        return $output;
    }
}
