<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 */
use Cake\I18n\FrozenTime;
$time = FrozenTime::now();
?>

<?php
$this->assign('title', __('Add Album'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/Galleries'],
    ['title' => __('List Albums'), 'url' => ['action' => 'index']],
    ['title' => __('Add')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($album, ['valueSources' => ['query', 'context']]) ?>
    <div class="card-body">
        <?= $this->Form->control('user_id', ['value'=>$this->Identity->get('id'),'type'=>'hidden', 'class' => 'form-control']) ?>
        <?= $this->Form->control('name') ?>
        <?= $this->Form->control('desk') ?>
        <?= $this->Form->control('date',['value'=>$time->i18nFormat('yyyy-MM-dd HH:mm:ss'),'readonly'=>true,'type'=>'hidden']) ?>
    </div>
    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>