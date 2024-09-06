import { createI18n } from 'vue-i18n'

const messages = {
  en: {
    title: 'Todo List',
    remove: 'Remove',
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
