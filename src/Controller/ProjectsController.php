<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $organization = $this->getOrganization();
        $query = $this->Projects->findByOrganizationId($organization->id);
        $query = $this->Authorization->applyScope($query);
        $projects = $this->paginate($query);

        $this->set(compact('projects', 'organization'));
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organization = $this->getOrganization();
        $project = $this->Projects->get($id, contain: ['Organizations', 'Teams']);
        $this->Authorization->authorize($project);
        $this->set(compact('project', 'organization'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organization = $this->getOrganization();
        $project = $this->Projects->newEmptyEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            $this->Authorization->authorize($project);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $teams = $this->Projects->Teams->find('list', limit: 200);
        $teams = $this->Authorization->applyScope($teams, 'index');
        $this->set(compact('project', 'organization', 'teams'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organization = $this->getOrganization();
        $project = $this->Projects->get($id, contain: ['Teams']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            $this->Authorization->authorize($project);
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $teams = $this->Projects->Teams->find('list', limit: 200);
        $teams = $this->Authorization->applyScope($teams, 'index');
        $this->set(compact('project', 'organization', 'teams'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $organization = $this->getOrganization();
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id, contain: ['Teams']);
        $this->Authorization->authorize($project);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index', 'orgslug' => $organization->slug]);
    }
}
