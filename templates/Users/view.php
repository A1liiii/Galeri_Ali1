<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

?>

<?php
$this->assign('title', __('User'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/Galleries'],
    ['title' => __('List Users'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($user->username) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Username') ?></th>
                <td><?= h($user->username) ?></td>
            </tr>
            <tr>
                <th><?= __('Email') ?></th>
                <td><?= h($user->email) ?></td>
            </tr>
            <tr>
                <th><?= __('Nama') ?></th>
                <td><?= h($user->fullname) ?></td>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
    <?php if ($this->Identity->get('id') === $user->id): ?>
        <div>
            <?= $this->Form->postLink(
                __('Hapus'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger mr-2']
            ) ?>
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-secondary mr-2']) ?>
        </div>
    <?php endif; ?>
    <?= $this->Html->link(__('Cancel'), ['controller'=>'Galleries','action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Alamat') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($user->address)); ?>
    </div>
</div>

<div class="related related-gallery view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Postingan') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <?php if (empty($user->galleries)) : ?>
                <tr>
                    <td colspan="8" class="text-muted">
                        <?= __('Galleries record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($user->galleries as $gallery) : ?>
                        <td><?= $this->html->image('galeri/'.$gallery->lockfile,['height' => '200px','width'=>'20%']) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Galleries', 'action' => 'view', $gallery->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

