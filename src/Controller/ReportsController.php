<?php

namespace App\Controller;


use Cake\ORM\TableRegistry;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * PointsOfSale Controller
 *
 * @property \App\Model\Table\SongsHistoryTable $songsHistoryTable
 *
 * @method \App\Model\Entity\SongsHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController {

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authorization->skipAuthorization();
    }

    public function dowloadReport($id) {
        $dataArray[0] = ['Título', 'Author', 'Fecha' , 'Punto de venta'];
        $query = $this->getTableLocator()->get('SongsHistory')->find()
            ->innerJoin('points_of_sale', 'SongsHistory.pos_id = points_of_sale.id')
            ->where(['points_of_sale.customer_id' => $id])
            ->select(['points_of_sale.name', 'SongsHistory.title', 'SongsHistory.author', 'SongsHistory.created']);
        $result = $query->toArray();
        foreach ($result as $value) {
            $dataArray[] = [$value->title, $value->author, $value->created, $value->points_of_sale['name']];
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($dataArray as $row => $data) {
            foreach ($data as $column => $value) {
                $sheet->setCellValueByColumnAndRow($column + 1, $row + 1, $value);
            }
        }

        $writer = new Xlsx($spreadsheet);
        $filePath = '/tmp/report_song_history.xlsx';
        $handle = fopen($filePath, 'w');
        fclose($handle);

        // Guarda el archivo
        $writer->save($filePath);

        return $this->response->withFile($filePath, ['download' => true]);
    }

}
