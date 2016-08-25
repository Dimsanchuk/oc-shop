<?php namespace Dshoreman\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Backend\Widgets\Grid;
use Illuminate\Support\Facades\Input;

class ItemGrid extends FormWidgetBase {
    protected $defaultAlias = 'itemgrid';

    public function widgetDetails()
    {
        return [
            'name' => 'Item Grid',
            'description' => 'Renders a grid of items from an order',
        ];
    }

    public function init()
    {
        /*$this->fillFromConfig([
            'modelClass',
            'selectFrom',
            'pattern'
        ]);
        $this->assertModelClass();*/
        parent::init();
    }

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('itemgrid');
    }

    public function prepareVars()
    {
        $this->vars['items'] = json_decode($this->formField->value);
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        $orderData = Array();
        $orderData['id'] = Input::get('title');
        $orderData['name'] = Input::get('name');
        $orderData['price'] = Input::get('price');
        $orderData['qty'] = Input::get('qty');
        $orderData['subtotal'] = $orderData['qty'] * $orderData['price'];

        $orderData = json_encode(Array($orderData));

        return $orderData;

    }

}
