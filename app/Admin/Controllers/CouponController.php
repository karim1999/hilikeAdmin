<?php

namespace App\Admin\Controllers;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Service;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CouponController extends Controller
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

            $content->header('Index');
            $content->description('description');

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

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Coupon::findOrFail($id), function (Show $show) {

                $show->id();

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
            $content->description('description');

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
            $content->description('description');

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
        return Admin::grid(Coupon::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->code('Code');
            $grid->amount('Amount')->display(function ($num) {
                return "<span class='label label-warning'>{$num}</span>";
            });

            $grid->discount('Discount (%)')->display(function ($num) {
                return "<span class='label label-success'>{$num} %</span>";
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Coupon::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select("service_id", "Service")->options(Service::all()->pluck('name_en', 'id'));
            $form->text('code', 'Code')->rules('required');
            $form->number('amount', 'Amount');
            $form->slider("discount" , "Discount (%)")->options(['max' => 100, 'min' => 1, 'step' => 5, 'postfix' => ' %'])->rules('required');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
