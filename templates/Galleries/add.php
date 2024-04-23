<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery $gallery
 */
use Cake\I18n\FrozenTime;
$time = FrozenTime::now();
?>

<?php
$this->assign('title', __('Add Gallery'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/Galleries'],
    ['title' => __('List Galleries'), 'url' => ['action' => 'index']],
    ['title' => __('Add')],
]);
?>
<div class="card card-primary card-outline">
    <?= $this->Form->create($gallery, ['valueSources' => ['query', 'context'],'type'=>'file']) ?>
    <div class="card-body">
        <?= $this->Form->control('user_id', ['value'=>$this->Identity->get('id'),'type'=>'hidden', 'class' => 'form-control']) ?>
        <?= $this->Form->control('album_id', ['options' => $albums, 'class' => 'form-control']) ?>
        <?= $this->Form->control('title',['label'=>'Judul']) ?>
        <?= $this->Form->control('desk',['label'=>'Caption']) ?>
        <?= $this->Form->control('date',['value'=>$time->i18nFormat('yyyy-MM-dd HH:mm:ss'),'readonly'=>true,'type'=>'hidden']) ?>
        <?= $this->Form->control('images',['type'=>'file','label'=>'Gambar']) ?>
    </div>
    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>