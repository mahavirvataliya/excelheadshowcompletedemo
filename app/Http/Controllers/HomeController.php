<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mahavirvataliya\ExcelHeader\ExcelHeader;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function upload(Request $request)
    {

        

        if($request->hasFile('xls')) {

            $file = $request->file('xls') ;

            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path() ;
            $file->move($destinationPath,$fileName);

            $rownno = $request->rowno==null?1:$request->rowno;
            $rows =  ExcelHeader::getExcelHeader(public_path().'/'.$fileName,$rownno);
           // dd($rows);
            return view('excelfile',compact('rows'));
        }
        else
        {
            $rows="";
            return view('excelfile',compact('rows'));
        }


    }
    public function upload1(Request $request)
    {
        $inputFileName = base_path().'/public/uploads/cars.xls';
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($inputFileName);
        $spreadsheet->getActiveSheet();
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load( $inputFileName);

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];
        $i=1;
        $rowno = 1;

        foreach ($worksheet->getRowIterator($rowno,$rowno) AS $row) {
           // if($row->getRowIndex()==$rowno){

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                $cells = [];
                foreach ($cellIterator as $cell) {
                    $cells[] = $cell->getValue();
                }


                $rows[] = $cells;
          //  }
            $i++;


        }

        return view('excelfile',compact('rows'));
    }
    public static function getexcelheader($filepath,$rowno){

        // $spreadsheet = IOFactory::load($inputFileName);
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];
        dd($spreadsheet->getSheetNames());

        foreach ($worksheet->getRowIterator($rowno,$rowno) AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
        }
        return json_encode($rows);
    }
    public static function getAllExcelHeader($filepath,$rowno=1){

         $spreadsheet = IOFactory::load($filepath);
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        //$spreadsheet = $reader->load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];
        $sheetnames = $spreadsheet->getSheetNames();
        foreach($sheetnames AS $sheetname)
        {
            $worksheet = $spreadsheet->getSheetByName($sheetname);
            foreach ($worksheet->getRowIterator($rowno,$rowno) AS $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                $cells = [];
                foreach ($cellIterator as $cell) {
                    $cells[] = $cell->getValue();
                }
                $rows[] = $cells;
            }
        }
        return json_encode($rows);
    }
}
