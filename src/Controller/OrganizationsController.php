<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Organizations Controller
 *
 * @property \App\Model\Table\OrganizationsTable $Organizations
 */
class OrganizationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Organizations->find();
        $query = $this->Authorization->applyScope($query);
        $organizations = $this->paginate($query);

        $this->set(compact('organizations'));
    }

    /**
     * View method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $organization = $this->Organizations
            ->findBySlug($this->request->getParam('orgslug'))
            ->contain(['OrganizationInvites', 'OrganizationMembers.Users', 'OrganizationOptions', 'Projects', 'Teams'])
            ->firstOrFail();
        $this->Authorization->authorize($organization);
        $this->set(compact('organization'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organization = $this->Organizations->newEmptyEntity();
        $this->Authorization->authorize($organization);
        if ($this->request->is('post')) {
            $organization = $this->Organizations->patchEntity($organization, $this->request->getData());
            $organization->organization_members = [
                $this->Organizations->OrganizationMembers->newEntity([
                        'user_id' => $this->request->getAttribute('identity')->id,
                        'organiation_id' => $organization->id,
                        'role' => 'owner',
                    ],
                    ['guard' => false],
                ),
            ];
            if ($this->Organizations->save($organization, ['associated' => ['OrganizationMembers']])) {
                $this->Flash->success(__('The organization has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization could not be saved. Please, try again.'));
        }
        $this->set(compact('organization'));
    }

    /**
     * Edit method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $organization = $this->getOrganization();
        $this->Authorization->authorize($organization);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organization = $this->Organizations->patchEntity($organization, $this->request->getData());
            if ($this->Organizations->save($organization)) {
                $this->Flash->success(__('The organization has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organization could not be saved. Please, try again.'));
        }
        $this->set(compact('organization'));
    }

    /**
     * Delete method
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
        $organization = $this->getOrganization();
        $this->Authorization->authorize($organization);
        if ($this->Organizations->delete($organization)) {
            $this->Flash->success(__('The organization has been deleted.'));
        } else {
            $this->Flash->error(__('The organization could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
