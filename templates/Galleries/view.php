<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery $gallery
 */
use Cake\I18n\FrozenTime;
$time = FrozenTime::now();
$likeCount = count($gallery->likes);
?>

<?php
$this->assign('title', __('Gallery'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/Galleries'],
    ['title' => __('List Galleries'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-flex flex-align-items-start">
        <div class="flex mr-2">
            <h2 class="card-title"><?= $this->Html->image('galeri/'.$gallery->lockfile, ['style' => 'height: 300px; width: 300px;']) ?></h2>
        </div>
        <div class="flex-grow-1">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <tr>
                        <th><?= __('<i class="fa fa-user" aria-hidden="true"></i>') ?></th>
                        <td><?= $gallery->has('user') ? $this->Html->link($gallery->user->username, ['controller' => 'Users', 'action' => 'view', $gallery->user->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('<i class="fa fa-images" aria-hidden="true"></i>') ?></th>
                        <td><?= $gallery->has('album') ? $this->Html->link($gallery->album->name, ['controller' => 'Albums', 'action' => 'view', $gallery->album->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('<i class="fa fa-heading" aria-hidden="true"></i>') ?></th>
                        <td><?= h($gallery->title) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('<i class="fa fa-calendar" aria-hidden="true"></i>') ?></th>
                        <td><?= date('j F Y', strtotime($gallery->date)) ?> | <?= date('H:i:s', strtotime($gallery->date)) ?> WIB</td>
                    </tr>
                    <tr>
                    <td>
                        <?php
                        $userLiked = $gallery->isLiked($this->Identity->get('id'));
                        if ($userLiked) {
                            echo $this->Form->create(null, [
                                'url' => [
                                    'controller' => 'Likes',
                                    'action' => 'delete',
                                    $userLiked->id
                                ],
                                'type' => 'post'
                            ]);
                            echo $this->Form->button('<i class="fa fa-heart"></i>', [
                                'class' => 'btn btn-danger mr-3',
                                'escapeTitle' => false
                            ]);
                        } else {
                            echo $this->Form->create(null, [
                                'url' => [
                                    'controller' => 'Likes',
                                    'action' => 'add'
                                ],
                                'type' => 'post'
                            ]);
                            echo $this->Form->control('date', [
                                'value' => $time->i18nFormat('yyyy-MM-dd HH:mm:ss'),
                                'type' => 'hidden'
                            ]);
                            echo $this->Form->control('user_id', [
                                'type' => 'hidden',
                                'value' => $this->Identity->get('id')
                            ]);
                            echo $this->Form->control('gallery_id', [
                                'type' => 'hidden',
                                'value' => $gallery->id
                            ]);
                            echo $this->Form->button('<i class="fa fa-heart"></i>', [
                                'class' => 'btn btn-outline-secondary mr-3',
                                'escapeTitle' => false
                            ]);
                        }
                        echo $likeCount;
                        echo $this->Form->end();
                        ?>
                    </td>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
    <?php if ($this->Identity->get('id') === $gallery->user_id): ?>
        <div>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $gallery->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $gallery->id), 'class' => 'btn btn-danger mr-2']
            ) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $gallery->id], ['class' => 'btn btn-secondary mr-2']) ?>
        </div>
    <?php endif; ?>
    <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
</div>
    

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Caption') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($gallery->desk)); ?>
    </div>
</div>


<div class="related related-comment view card">
<div class="card-header">
        <h3 class="card-title"><?= __('Komentar') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <?php foreach ($gallery->comments as $comment) : ?>
            <tr>
                <td><?= h($users[$comment->user_id]) ?></td>
                <td><?= h($comment->comment_content) ?></td>
                <td><?= date('j F Y', strtotime($comment->date)) ?> | <?= date('H:i:s', strtotime($comment->date)) ?> WIB</td>
                <td class="actions">
                    <?php if ($this->Identity->get('id') === $comment->user_id) : ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comment->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr> 
                <td colspan='6'>
                <?= $this->form->create(null, ['url'=>['controller'=>'Comments','action'=>'add'],'role'=>'form']) ?>
                <div class="card-body">
                <?= $this->Form->control('date',['value' => $time->i18nFormat('yyyy-MM-dd HH:mm:ss'),'type' => 'hidden']) ?>
                    <?= $this->Form->control('comment_content',['value' => '','type' => 'textarea','label'=>'Komentar Disini']) ?> 
                    <?= $this->Form->control('user_id', ['type' => 'hidden','value'=>$this->Identity->get('id'), 'class' => 'form-control']) ?>
                    <?= $this->Form->control('gallery_id', ['type' => 'hidden','value' => $gallery->id, 'class' => 'form-control']) ?>
                </div>
                <div class="card-footer d-flex">
                <div class="ml-auto">
                    <?= $this->Form->button('<i class="fas fa-paper-plane"></i>', ['class' => 'btn btn-primary', 'escapeTitle' => false]) ?>
                </div>

                </div>
                <?= $this->Form->end() ?>
                </td>
            </tr>
        </table>
    </div>
</div>




