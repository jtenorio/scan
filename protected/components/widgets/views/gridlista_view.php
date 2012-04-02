<?php


$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>$id.'-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>$columns
));
//array(
//               'customer_id',
//                'store_id',
//                'first_name',
//                'last_name',
//                'email',
//                'address_id',
//                array(
//                    'class'=>'CButtonColumn',
//                ),
//           ),
?>
