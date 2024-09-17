import { createI18n } from 'vue-i18n'

const messages = {
  en: {
    title: 'Todo List',
    remove: 'Remove',
    name: 'Name',
    status: 'Status',
    deadline: 'Deadline',
    addTask: 'Add Task',
    exportTask: 'Export List',
    modal: {
      addTaskTitle: 'Add New Item',
    },
    taskName: 'Task Name',
    enterItemName: 'Enter task name',
    status: 'Status',
    selectStatus: 'Select status',
    statusPending: 'Pending',
    statusInProgress: 'In Progress',
    statusDone: 'Done',
    deadline: 'Deadline',
    selectDeadline: 'Select deadline',
    attachFile: 'Attach a file',
    chooseFile: 'Choose File(.xlsx)',
    createUpdateTask: 'Create/Update Task',
    cancel: 'Cancel',
    nameAndDeadlineRequired:
      'Name and deadline are required for creating/updating tasks',
    addNewItem: 'Add New Item',
    failedToSaveItem: 'Failed to save item: {message}',
    createdAt: 'Created At',
    editItem: 'Edit Item',
    enterItemName: 'Enter item name',
    statusInProgress: 'In Progress',
    statusPending: 'Pending',
    statusDone: 'Done',
    saveChanges: 'Save Changes',
    nameAndDeadlineRequired: 'Name and deadline are required',
    failedToUpdateItem: 'Failed to update item: {message}',
    statusUnknown: 'Unknown status',
    testCommit4: 'Commit4',
  },

  ru: {
    title: 'Список задач',
  },
}

const i18n = createI18n({
  locale: 'en',
  fallbackLocale: 'en',
  messages,
})

export default i18n
