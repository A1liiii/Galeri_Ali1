<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Album $album
 */
?>

<?php
$this->assign('title', __('Album'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/Galleries'],
    ['title' => __('List Albums'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($album->name) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('User') ?></th>
                <td><?= $album->has('user') ? $this->Html->link($album->user->username, ['controller' => 'Users', 'action' => 'view', $album->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($album->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Date') ?></th>
                <td><?= date('d F Y H:i:s', strtotime($album->date)) ?>  WIB</td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
    <?php if ($this->Identity->get('id') === $album->user_id): ?>
        <div>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $album->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $album->id), 'class' => 'btn btn-danger mr-2']
            ) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $album->id], ['class' => 'btn btn-secondary mr-2']) ?>
        </div>
    <?php endif; ?>
    <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Desk') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($album->desk)); ?>
    </div>
</div>

<div class="related related-gallery view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Gambar') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Album Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Desk') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Lockfile') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php if (empty($album->galleries)) : ?>
                <tr>
                    <td colspan="8" class="text-muted">
                        <?= __('Galleries record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($album->galleries as $gallery) : ?>
                    <tr>
                        <td><?= h($gallery->id) ?></td>
                        <td><?= h($gallery->user_id) ?></td>
                        <td><?= h($gallery->album_id) ?></td>
                        <td><?= h($gallery->title) ?></td>
                        <td><?= h($gallery->desk) ?></td>
                        <td><?= date('j F Y', strtotime($gallery->date)) ?> | <?= date('H:i:s', strtotime($gallery->date)) ?> WIB</td>
                        <td><?= $this->html->image('galeri/'.$gallery->lockfile,['height' => '100px']) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Galleries', 'action' => 'view', $gallery->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Galleries', 'action' => 'edit', $gallery->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Galleries', 'action' => 'delete', $gallery->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $gallery->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
