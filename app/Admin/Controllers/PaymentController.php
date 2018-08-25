<?php

namespace App\Admin\Controllers;

use App\Payment;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PaymentController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Payments');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Payment');
            $content->description('');

            $content->body(Admin::show(Payment::findOrFail($id), function (Show $show) {

                $show->id();
                $show->user()->name('User');
                $show->service()->name_en('Service');
                $show->price('Price')->label('info');
                $show->status()->select([
                    0 => 'Pending',
                    1 => 'Completed',
                    2 => 'Rejected',
                ]);

                $show->created_at();
                $show->updated_at();
            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Edit');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Create');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Payment::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->user()->username('User');
            $grid->service()->name_en('Service');
            $grid->price('Price');
            $grid->status()->select([
                0 => 'Pending',
                1 => 'Completed',
                2 => 'Rejected',
            ]);
            $grid->created_at();
            $grid->updated_at();
            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableEdit();
            });
            $grid->filter(function($filter){

                $filter->equal('user_id')->select(User::all()->pluck('username', 'id'));

            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Payment::class, function (Form $form) {

            $Type= Array(0 => "Pending",1 => "Completed", 2 => "Rejected");
            $form->select("status")->options($Type)->rules('required');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
