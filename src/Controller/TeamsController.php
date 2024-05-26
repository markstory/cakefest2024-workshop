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
        $query = $this->Teams->find()
            ->contain(['Organizations']);
        $query = $this->Authorization->applyScope($query);
        $teams = $this->paginate($query);

        $this->set(compact('teams'));
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
        $team = $this->Teams->get($id, contain: ['Organizations', 'Projects', 'OrganizationMembers.Users']);
        $this->Authorization->authorize($team);
        $this->set(compact('team'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $team = $this->Teams->newEmptyEntity();

        if ($this->request->is('post')) {
            $team = $this->Teams->patchEntity($team, $this->request->getData());
            $this->Authorization->authorize($team);
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $organizations = $this->Teams->Organizations->find('list', limit: 200);
        $organizations = $this->Authorization->applyScope($organizations, 'index');
        $projects = $this->Teams->Projects->find('list', limit: 200);
        $projects = $this->Authorization->applyScope($projects, 'index');
        $members = $this->Teams->OrganizationMembers->find('list', limit: 200);
        $members = $this->Authorization->applyScope($members, 'index');
        $this->set(compact('team', 'organizations', 'projects', 'members'));
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
        $team = $this->Teams->get($id, contain: ['Projects']);
        $this->Authorization->authorize($team);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $team = $this->Teams->patchEntity($team, $this->request->getData());
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $organizations = $this->Teams->Organizations->find('list', limit: 200)->all();

        $projects = $this->Teams->Projects->find('list', limit: 200);
        $projects = $this->Authorization->applyScope($projects, 'index');

        $members = $this->Teams->OrganizationMembers->find('list', limit: 200);
        $members = $this->Authorization->applyScope($members, 'index');
        $this->set(compact('team', 'organizations', 'projects', 'members'));
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
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        $this->Authorization->authorize($team);
        if ($this->Teams->delete($team)) {
            $this->Flash->success(__('The team has been deleted.'));
        } else {
            $this->Flash->error(__('The team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
