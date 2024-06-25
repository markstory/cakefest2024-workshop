<?php
$this->setLayout('ajax');

echo $this->element('Teams/table_row', [
    'organization' => $organization,
    'team' => $team,
    'user' => $user,
]);
