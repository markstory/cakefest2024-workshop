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
    public function view(?string $id = null)
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
        $organization = $this->getOrganization();
        $organizationInvite = $this->OrganizationInvites->newEmptyEntity();
        $organizationInvite->organization_id = $organization->id;
        $this->Authorization->authorize($organizationInvite);

        if ($this->request->is('post')) {
            $organizationInvite = $this->OrganizationInvites->patchEntity($organizationInvite, $this->request->getData());
            $organizationInvite->refreshVerifyToken();
            if ($this->OrganizationInvites->save($organizationInvite)) {
                $this->Flash->success(__('The organization invite has been saved.'));

                return $this->redirect(['controller' => 'Organizations', 'action' => 'view', $organizationInvite->organization_id]);
            }
            $this->Flash->error(__('The organization invite could not be saved. Please, try again.'));
        }
        $organizations = $this->OrganizationInvites->Organizations->find('list', limit: 200);
        $organizations = $this->Authorization->applyScope($organizations, 'index');
        $this->set(compact('organizationInvite', 'organizations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Organization Invite id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
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

    /**
     * Accept an invite, creatin a member from the invite
     *
     * @return \Cake\Http\Response|null Redirect to org details
     */
    public function accept($token)
    {
        $invite = $this->OrganizationInvites->findByVerifyToken($token)->firstOrFail();
        $user = $this->Authentication->getIdentity();
        if ($user->email != $invite->email) {
            $this->Flash->error(__('You cannot accept an invitation for someone else.'));

            return $this->redirect(['controller' => 'Organizations', 'action' => 'view', $invite->organization_id]);
        }

        $this->OrganizationInvites->getConnection()->transactional(function () use ($invite, $user) {
            $member = $this->OrganizationInvites->OrganizationMembers->newEntity([
                'organization_id' => $invite->organization_id,
                'role' => $invite->role,
                'user_id' => $user->id,
            ]);
            $this->OrganizationInvites->OrganizationMembers->saveOrFail($member);
            $this->OrganizationInvites->delete($invite);

            $this->Flash->success(__('Invite accepted'));
        });

        return $this->redirect(['controller' => 'Organizations', 'action' => 'view', $invite->organization_id]);
    }
}
