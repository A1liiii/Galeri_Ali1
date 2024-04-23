<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Galleries Controller
 *
 * @property \App\Model\Table\GalleriesTable $Galleries
 */
class GalleriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Galleries->find()
            ->contain(['Users', 'Albums']);
        $galleries = $this->paginate($query);

        $this->set(compact('galleries'));
    }

    /**
     * View method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gallery = $this->Galleries->get($id, contain: ['Users', 'Albums', 'Comments', 'Likes']);
        $users = $this->Galleries->Users->find('list')->all();
        $users = $users->toArray();
        $this->set(compact('gallery','users'));
        $gallery = $this->Galleries->get($id, [
            'contain' => ['Likes']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gallery = $this->Galleries->newEmptyEntity();
        if ($this->request->is('post')) {
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
            $file = $this->request->getUploadedFiles(); 

            $gallery->lockfile = $file['images']->getClientFilename(); 
            $file['images']->moveTo(WWW_ROOT . 'img' . DS . 'galeri' . DS . $gallery->lockfile); 
            if ($this->Galleries->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
        }
        $users = $this->Galleries->Users->find('list', limit: 200)->all();
        $albums = $this->Galleries->Albums->find('list', limit: 200)->all();
        $this->set(compact('gallery', 'users', 'albums'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gallery = $this->Galleries->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gallery = $this->Galleries->patchEntity($gallery, $this->request->getData());
            $file = $this->request->getUploadedFiles(); 
            if(!empty($file['images']->getClientFilename())){
            $gallery->lockfile = $file['images']->getClientFilename(); 
            $file['images']->moveTo(WWW_ROOT . 'img' . DS . 'galeri' . DS . $gallery->lockfile); 
            }
            if ($this->Galleries->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
        }
        $users = $this->Galleries->Users->find('list', limit: 200)->all();
        $albums = $this->Galleries->Albums->find('list', limit: 200)->all();
        $this->set(compact('gallery', 'users', 'albums'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gallery = $this->Galleries->get($id);
        if ($this->Galleries->delete($gallery)) {
            $this->Flash->success(__('The gallery has been deleted.'));
        } else {
            $this->Flash->error(__('The gallery could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
