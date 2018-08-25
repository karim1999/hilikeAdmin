<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Service;
use App\Ticket;
use App\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Hilike');


            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $num= User::count();
                    $infoBox = new InfoBox('Users', 'users', 'aqua', '/admin/users', $num);
                    $column->append($infoBox->render());
                });

                $row->column(4, function (Column $column) {
                    $num= Ticket::count();
                    $infoBox = new InfoBox('Tickets', 'sticky-note', 'red', '/admin/tickets', $num);
                    $column->append($infoBox->render());
                });

                $row->column(4, function (Column $column) {
                    $num= Service::count();
                    $infoBox = new InfoBox('Services', 'server', 'blue', '/admin/services', $num);
                    $column->append($infoBox->render());
                });
            });

            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
        });
    }
}
