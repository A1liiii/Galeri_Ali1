<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gallery[]|\Cake\Collection\CollectionInterface $galleries
 */
?>

<?php
$this->assign('title', __('Postingan'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/Galleries'],
    ['title' => __('List Galleries')],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-header d-flex flex-column flex-md-row">
        <h2 class="card-title">
            <!-- -->
        </h2>
        <div class="d-flex ml-auto">
            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control form-control-sm',
                'templates' => ['inputContainer' => '{{content}}']
            ]); ?>
            <?= $this->Html->link(__('New Gallery'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm ml-2']) ?>
        </div>
    </div>
    <style>
            
            .card-title-container {
                display: flex;
                justify-content: space-between;
                align-items: baseline;
                
            }
            .card-title {
                font-weight: bold;
            }
            .card:hover {
                transition: box-shadow 0.3s ease-in-out;
            }
            .card img:hover {
                cursor: pointer;
            }
        </style>

        <div class="container mt-4">
            <div class="row">
                <?php foreach ($galleries as $gallery): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <a href="<?= $this->Url->build(['action' => 'view', $gallery->id]) ?>"><img src="<?= 'img/galeri/' . $gallery->lockfile ?>" class="card-img-top mt-3" style="height: 200px; width: 300px; margin-top: 5px; margin-left:30px;" alt="Evidence">
                            <div class="card-body">
                                <div class="card-title-container">
                                    <h5 class="card-title mb-2"><?= $gallery->has('user') ? h($gallery->user->username) : '' ?></h5>
                                    <small class="text-muted"><?= h($gallery->date) ?></small>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <!-- /.card-body -->
    <div class="card-footer d-flex flex-column flex-md-row">
        <div class="text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination pagination-sm mb-0 ml-auto">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
    </div>
    <!-- /.card-footer -->
</div>