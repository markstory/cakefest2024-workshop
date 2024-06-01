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
        $organization = $this->getOrganization();
        $query = $this->OrganizationMembers->findByOrganizationId($organization->id)
            ->contain(['Users']);
        $query = $this->Authorization->applyScope($query);
        $organizationMembers = $this->paginate($query);

        $this->set(compact('organizationMembers', 'organization'));
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
        $organization = $this->getOrganization();
        $organizationMember = $this->OrganizationMembers->get($id, contain: ['Users', 'OrganizationInvites', 'TeamMembers.Teams']);
        $this->Authorization->authorize($organizationMember);
        $this->set(compact('organizationMember', 'organization'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organization = $this->getOrganization();
        $this->Authorization->authorize($organization, 'edit');

        $organizationMember = $this->OrganizationMembers->newEmptyEntity();
        if ($this->request->is('post')) {
            $organizationMember = $this->OrganizationMembers->patchEntity($organizationMember, $this->request->getData());
            $organizationMember->organization_id = $organization->id;
            $this->Authorization->authorize($organizationMember);
            if ($this->OrganizationMembers->save($organizationMember)) {
                $this->Flash->success(__('The organization member has been saved.'));

                return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
            }
            $this->Flash->error(__('The organization member could not be saved. Please, try again.'));
        }
        $users = $this->OrganizationMembers->Users->find('list', limit: 200)->all();
        $this->set(compact('organizationMember', 'organization', 'users'));
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
        $organization = $this->getOrganization();
        $organizationMember = $this->OrganizationMembers->get($id, contain: []);
        $this->Authorization->authorize($organizationMember);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $organizationMember = $this->OrganizationMembers->patchEntity($organizationMember, $this->request->getData());
            if ($this->OrganizationMembers->save($organizationMember)) {
                $this->Flash->success(__('The organization member has been saved.'));

                return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
            }
            $this->Flash->error(__('The organization member could not be saved. Please, try again.'));
        }
        $users = $this->OrganizationMembers->Users->find('list', limit: 200)->all();
        $this->set(compact('organizationMember', 'organization', 'users'));
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
        $organization = $this->getOrganization();
        $this->request->allowMethod(['post', 'delete']);
        $organizationMember = $this->OrganizationMembers->get($id);
        if ($this->OrganizationMembers->delete($organizationMember)) {
            $this->Flash->success(__('The organization member has been deleted.'));
        } else {
            $this->Flash->error(__('The organization member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
    }
}
