<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $organization = $this->getOrganization();
        $query = $this->Teams->findByOrganizationId($organization->id);
        $query = $this->Authorization->applyScope($query);
        $teams = $this->paginate($query);

        $this->set(compact('teams', 'organization'));
    }

    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organization = $this->getOrganization();
        $team = $this->Teams->get($id, contain: ['Projects', 'OrganizationMembers.Users']);
        $this->Authorization->authorize($team);
        $this->set(compact('team', 'organization'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $team = $this->Teams->newEmptyEntity();
        $organization = $this->getOrganization();

        if ($this->request->is('post')) {
            $team = $this->Teams->patchEntity($team, $this->request->getData());
            $team->organization_id = $organization->id;

            $this->Authorization->authorize($team);
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $projects = $this->Teams->Projects->find('list', limit: 200);
        $projects = $this->Authorization->applyScope($projects, 'index');
        $members = $this->Teams->OrganizationMembers->find(
            'list',
            valueField: 'user.name',
            limit: 200
        )->contain('Users');
        $members = $this->Authorization->applyScope($members, 'index');
        $this->set(compact('team', 'organization', 'projects', 'members'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organization = $this->getOrganization();
        $team = $this->Teams->get($id, contain: ['Projects']);
        $this->Authorization->authorize($team);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $team = $this->Teams->patchEntity($team, $this->request->getData());
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $projects = $this->Teams->Projects->find('list', limit: 200);
        $projects = $this->Authorization->applyScope($projects, 'index');

        $members = $this->Teams->OrganizationMembers->find(
            'list',
            valueField: 'user.name',
            limit: 200
        )->contain('Users');

        $members = $this->Authorization->applyScope($members, 'index');
        $this->set(compact('team', 'organization', 'projects', 'members'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $organization = $this->getOrganization();
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        $this->Authorization->authorize($team);
        if ($this->Teams->delete($team)) {
            $this->Flash->success(__('The team has been deleted.'));
        } else {
            $this->Flash->error(__('The team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
    }
}
