<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery $gallery
 */

?>

<?php
$this->assign('title', __('Edit Gallery'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/Galleries'],
    ['title' => __('List Galleries'), 'url' => ['action' => 'index']],
    ['title' => __('View'), 'url' => ['action' => 'view', $gallery->id]],
    ['title' => __('Edit')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($gallery,['type'=>'file']) ?>
    <div class="card-body">
        <?= $this->Form->control('user_id', ['value'=>$this->Identity->get('id'),'type'=>'hidden', 'class' => 'form-control']) ?>
        <?= $this->Form->control('album_id', ['value'=>$this->Identity->get('id'), 'class' => 'form-control']) ?>
        <?= $this->Form->control('title') ?>
        <?= $this->Form->control('desk') ?>
        <?= $this->Form->control('date',['readonly'=>true]) ?>
        <?= $this->Html->image('galeri/'.$gallery->lockfile,['height'=>'100px']) ?> 
        <?= $this->Form->control('lockfile',['type'=>'hidden']) ?>
        <?= $this->Form->control('images',['type'=>'file','label'=>'Gambar']) ?>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $gallery->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $gallery->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'view', $gallery->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>