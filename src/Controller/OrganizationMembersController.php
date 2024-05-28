<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * OrganizationMembers Controller
 *
 * @property \App\Model\Table\OrganizationMembersTable $OrganizationMembers
 */
class OrganizationMembersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrganizationMembers->find()
            ->contain(['Organizations', 'Users']);
        $query = $this->Authorization->applyScope($query);
        $organizationMembers = $this->paginate($query);

        $this->set(compact('organizationMembers'));
    }

    /**
     * View method
     *
     * @param string|null $id Organization Member id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organizationMember = $this->OrganizationMembers->get($id, contain: ['Organizations', 'Users', 'OrganizationInvites', 'TeamMembers.Teams']);
        $this->Authorization->authorize($organizationMember);
        $this->set(compact('organizationMember'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organizationMember = $this->OrganizationMembers->newEmptyEntity();
        if ($this->request->is('post')) {
            $organizationMember = $this->OrganizationMembers->patchEntity($organizationMember, $this->request->getData());
            $this->Authorization->authorize($organizationMember);
            if ($this->OrganizationMembers->save($organizationMember)) {
                $this->Flash->success(__('The organization member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization member could not be saved. Please, try again.'));
        }
        // TODO remove users and limit organization based on current membership
        // TODO remove this, and use invitation links inteas
        $organizations = $this->OrganizationMembers->Organizations->find('list', limit: 200);
        $organizations = $this->Authorization->applyScope($organizations, 'index');
        $users = $this->OrganizationMembers->Users->find('list', limit: 200)->all();
        $this->set(compact('organizationMember', 'organizations', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Organization Member id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organizationMember = $this->OrganizationMembers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organizationMember = $this->OrganizationMembers->patchEntity($organizationMember, $this->request->getData());
            $this->Authorization->authorize($organizationMember);
            if ($this->OrganizationMembers->save($organizationMember)) {
                $this->Flash->success(__('The organization member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization member could not be saved. Please, try again.'));
        }
        $organizations = $this->OrganizationMembers->Organizations->find('list', limit: 200);
        $organizations = $this->Authorization->applyScope($organizations, 'index');
        $users = $this->OrganizationMembers->Users->find('list', limit: 200)->all();
        $this->set(compact('organizationMember', 'organizations', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Organization Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $organizationMember = $this->OrganizationMembers->get($id);
        if ($this->OrganizationMembers->delete($organizationMember)) {
            $this->Flash->success(__('The organization member has been deleted.'));
        } else {
            $this->Flash->error(__('The organization member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
