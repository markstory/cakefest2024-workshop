<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrganizationInvites Controller
 *
 * @property \App\Model\Table\OrganizationInvitesTable $OrganizationInvites
 */
class OrganizationInvitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrganizationInvites->find()
            ->contain(['Organizations', 'OrganizationMembers']);
        $organizationInvites = $this->paginate($query);

        $this->set(compact('organizationInvites'));
    }

    /**
     * View method
     *
     * @param string|null $id Organization Invite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organizationInvite = $this->OrganizationInvites->get($id, contain: ['Organizations', 'OrganizationMembers']);
        $this->set(compact('organizationInvite'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organizationInvite = $this->OrganizationInvites->newEmptyEntity();
        if ($this->request->is('post')) {
            $organizationInvite = $this->OrganizationInvites->patchEntity($organizationInvite, $this->request->getData());
            if ($this->OrganizationInvites->save($organizationInvite)) {
                $this->Flash->success(__('The organization invite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization invite could not be saved. Please, try again.'));
        }
        $organizations = $this->OrganizationInvites->Organizations->find('list', limit: 200)->all();
        $organizationMembers = $this->OrganizationInvites->OrganizationMembers->find('list', limit: 200)->all();
        $this->set(compact('organizationInvite', 'organizations', 'organizationMembers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Organization Invite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organizationInvite = $this->OrganizationInvites->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organizationInvite = $this->OrganizationInvites->patchEntity($organizationInvite, $this->request->getData());
            if ($this->OrganizationInvites->save($organizationInvite)) {
                $this->Flash->success(__('The organization invite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization invite could not be saved. Please, try again.'));
        }
        $organizations = $this->OrganizationInvites->Organizations->find('list', limit: 200)->all();
        $organizationMembers = $this->OrganizationInvites->OrganizationMembers->find('list', limit: 200)->all();
        $this->set(compact('organizationInvite', 'organizations', 'organizationMembers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Organization Invite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $organizationInvite = $this->OrganizationInvites->get($id);
        if ($this->OrganizationInvites->delete($organizationInvite)) {
            $this->Flash->success(__('The organization invite has been deleted.'));
        } else {
            $this->Flash->error(__('The organization invite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
