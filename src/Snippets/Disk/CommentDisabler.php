<?php


namespace Snippets\Disk;


use Bitrix\Disk\AttachedObject;
use Bitrix\Main\NotImplementedException;
use CTaskItem;
use CUser;


class CommentDisabler {
    /**
     * Обработчик события `tasks:OnTaskUpdate`.
     *
     * @param int $taskId
     */
    public static function disableAutoComment(int $taskId): void {
        global $USER;

        if (!($USER instanceof CUser) || $USER->GetID() === null) {
            return;
        }

        $task = CTaskItem::getInstance($taskId, $USER->GetID());

        $attachments = $task->getAttachmentIds();
        foreach ($attachments as $attachment) {
            try {
                $attachedObject = AttachedObject::getById($attachment);
                $attachedObject->disableAutoComment();
            } catch (NotImplementedException $e) {
                // Bitrix lies to you: this exception cannot be thrown.
            }
        }
    }
}