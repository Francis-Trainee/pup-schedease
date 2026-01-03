<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Room;

class RoomManagement extends Component
{
    public $showModal = false;
    public $showDeactivateModal = false;

    public $roomId;
    public $room_name;
    public $room_type;
    public $status = 'active';

    public $isEdit = false;

    // for warning modal
    public $roomToDeactivate;
    public $roomName;

    protected $rules = [
        'room_name' => 'required|string|max:255',
        'room_type' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ];

    /* ---------- MODAL ---------- */

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['roomId', 'room_name', 'room_type', 'status', 'isEdit']);
        $this->status = 'active';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    /* ---------- CRUD ---------- */

    public function save()
    {
        $this->validate();

        Room::create([
            'room_name' => $this->room_name,
            'room_type' => $this->room_type,
            'status' => $this->status,
        ]);

        $this->closeModal();
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);

        $this->roomId = $room->id;
        $this->room_name = $room->room_name;
        $this->room_type = $room->room_type;
        $this->status = $room->status;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        Room::findOrFail($this->roomId)->update([
            'room_name' => $this->room_name,
            'room_type' => $this->room_type,
            'status' => $this->status,
        ]);

        $this->closeModal();
    }

    /* ---------- DEACTIVATE WITH WARNING ---------- */

    public function confirmDeactivate($id)
    {
        $room = Room::findOrFail($id);

        // if inactive, activate immediately
        if ($room->status === 'inactive') {
            $room->update(['status' => 'active']);
            return;
        }

        $this->roomToDeactivate = $room->id;
        $this->roomName = $room->room_name;
        $this->showDeactivateModal = true;
    }

    public function deactivateRoom()
    {
        Room::findOrFail($this->roomToDeactivate)
            ->update(['status' => 'inactive']);

        $this->closeDeactivateModal();
    }

    public function closeDeactivateModal()
    {
        $this->reset(['showDeactivateModal', 'roomToDeactivate', 'roomName']);
    }

    public function render()
    {
        return view('livewire.admin.room-management', [
            'rooms' => Room::latest()->get(),
        ]);
    }
}
