<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\JsExpression;
use kartik\widgets\FileInput;
use app\modules\yii2extensions\models\Image;
use wbraganca\dynamicform\DynamicFormWidget;
$absoluteBaseUrl = Url::base(true);
?>

<div id="panel-option-values" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-check-square-o"></i>Product Images</h3>
    </div>
    <?php
        $count = count($modelImagees);
        $min=0;
        if($count==0){
            $min=1;
        } 
    ?>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.form-options-body',
        'widgetItem' => '.form-options-item',
        'min' => $min,
        'insertButton' => '.add-item',
        'deleteButton' => '.delete-item',
        'model' => $modelImages[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            //'id',
            //'name',
            'image'
        ],
    ]); ?>

    <table class="table table-bordered table-striped margin-b-none">
        <thead>
            <tr>
                <!-- <th style="width: 90px; text-align: center"></th> -->
                
                <th style="width: 188px;">Image</th>
                
                <th style="width: 90px; text-align: center">Actions</th>
            </tr>
        </thead>
        <tbody class="form-options-body">
        
        <?php foreach ($modelImagees as $index1 => $modelImage): ?>
                <?php $index = 10+$index1; ?>
                <tr class="form-options-item1">
                    <!-- <td class="sortable-handle text-center vcenter" style="cursor: move;">
                        <i class="fa fa-arrows"></i>
                    </td> -->
                    
                    <td class="w-40">
                        <?php if (!$modelImage->isNewRecord): ?>
                            <?= Html::activeHiddenInput($modelImage, "[{$index}]id"); ?>
                        <?php endif; ?>
                         <?php
                            $initialPreview = [];
                            if (!$modelImage->isNewRecord) {
                                $pathImg = $absoluteBaseUrl.'/uploads/' . $modelImage->image;
                                echo $initialPreview[] = Html::img($pathImg, ['class' => 'file-preview-image', 'style' =>"height:100px"]);
                            ?>
                                <?= Html::activeHiddenInput($modelImage, "[{$index}]image"); ?>
                            <?php
                            }
                        ?>
                        
                        <?php /*= $form->field($modelImage, "[{$index}]image")->label(false)->widget(FileInput::classname(), [
                            'options' => [
                                'multiple' => false,
                                'accept' => 'image/*',
                                'class' => 'optionvalue-image'
                            ],
                            'pluginOptions' => [
                                'previewFileType' => 'image',
                                'showCaption' => false,
                                'showUpload' => true,
                                'browseClass' => 'btn btn-default btn-sm btn-add-new',
                                'browseLabel' => ' Pick image',
                                'browseIcon' => '<i class="fa-solid fa-image"></i>',
                                'removeClass' => 'btn btn-danger btn-sm',
                                'removeLabel' => ' Delete',
                                'removeIcon' => '<i class="fa fa-trash"></i>',
                                'previewSettings' => [
                                    'image' => ['width' => '138px', 'height' => 'auto']
                                ],
                                'initialPreview' => $initialPreview,
                                'layoutTemplates' => ['footer' => '']
                            ]
                        ]) */?>
                       
                    </td>
                    <td class="text-center vcenter">
                        <button type="button" class="delete-item btn btn-danger btn-xs" onclick="$(this).closest('tr').remove();"><i class="fa fa-minus"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php foreach ($modelImages as $index => $modelImage): ?>
                <?php //$index = count($modelImagees)+$index1 ; ?>
                <tr class="form-options-item">
                    <!-- <td class="sortable-handle text-center vcenter" style="cursor: move;">
                        <i class="fa fa-arrows"></i>
                    </td> -->
                    
                    <td class="w-40">
                        <?php if (!$modelImage->isNewRecord): ?>
                            <?= Html::activeHiddenInput($modelImage, "[{$index}]id"); ?>
                        <?php endif; ?>
                         <?php
                            $initialPreview = [];
                            if (!$modelImage->isNewRecord) {
                                $pathImg = $absoluteBaseUrl.'/uploads/' . $modelImage->image;
                                //echo Html::img($pathImg, ['class' => 'file-preview-image', 'style' =>"height:100px"]);
                            }
                        ?>
                    
                        <?php /* $form->field($modelImage, "[{$index}]image")->fileInput() */?>
                        <?= $form->field($modelImage, "[{$index}]image")->label(false)->widget(FileInput::classname(), [
                            'options' => [
                                'multiple' => false,
                                'accept' => 'image/*',
                                'class' => 'optionvalue-image'
                            ],
                            'pluginOptions' => [
                                'previewFileType' => 'image',
                                'showCaption' => false,
                                'showUpload' => true,
                                'browseClass' => 'btn btn-default btn-sm btn-add-new',
                                'browseLabel' => ' Pick image',
                                'browseIcon' => '<i class="fa-solid fa-image"></i>',
                                'removeClass' => 'btn btn-danger btn-sm',
                                'removeLabel' => ' Delete',
                                'removeIcon' => '<i class="fa fa-trash"></i>',
                                'previewSettings' => [
                                    'image' => ['width' => '138px', 'height' => 'auto']
                                ],
                               // 'initialPreview' => $initialPreview,
                                'layoutTemplates' => ['footer' => '']
                            ]
                        ]) ?>
                       
                    </td>
                    <td class="text-center vcenter">
                        <button type="button" class="delete-item btn btn-danger btn-xs" id="deleteitem<?php echo $index;?>"><i class="fa fa-minus"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>    
        <?php //die;?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td class="text-center vcenter"><button type="button" class="add-item btn btn-success btn-sm"><span class="fa fa-plus"></span>Add New</button></td>
            </tr>
        </tfoot>
    </table>
    <?php DynamicFormWidget::end(); ?>
</div>

<?php
$js = <<<'EOD'

$(".optionvalue-image").on("filecleared", function(event) {
    var regexID = /^(.+?)([-\d-]{1,})(.+)$/i;
    var id = event.target.id;
    var matches = id.match(regexID);
    if (matches && matches.length === 4) {
        var identifiers = matches[2].split("-");
        $("#optionvalue-" + identifiers[1] + "-deleteimg").val("1");
    }
});

var fixHelperSortable = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

EOD;
if (count($modelImagees) > 0) {
    $this->registerJs("
        $( document ).ready(function() {
            $('.form-options-item11').addClass('form-options-item');

        });
    ");
}
//AppAsset::register($this);
$this->registerJs($js);
?>