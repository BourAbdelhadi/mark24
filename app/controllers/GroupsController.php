<?php

class GroupsController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function showIndex($groupId) {
        // check first if groupId is valid
        $group = Group::find($groupId);
        if(!is_numeric($groupId) || empty($group)) {
            App::abort('404');
        }

        // get current user groups
        $groups = Group::getMyGroups();

        return View::make('group.index')
            ->with('groupDetails', $group)
            ->with('groups', $groups);
    }

    public function showMembers($groupId) {
        // check first if groupId is valid
        $group = Group::find($groupId);
        if(!is_numeric($groupId) || empty($group)) {
            App::abort('404');
        }

        // get group owner
        $owner = User::find($group->owner_id);
        // get current user groups
        $groups = Group::getMyGroups();
        // get group members
        $groupMembers = GroupMember::getGroupMembers($groupId);

        return View::make('group.members')
            ->with('groupDetails', $group)
            ->with('groups', $groups)
            ->with('ownerDetails', $owner)
            ->with('members', $groupMembers);
    }

}
