import store from '~/store'

export default async (to, from, next) => {
  if (!store.getters['auth/check'] && store.getters['auth/token']) {
    try {
      await store.dispatch('auth/fetchUser');
      await store.dispatch('permissions/fetchUserPermissions')
      // await store.dispatch('projects/fetchProjects')
    } catch (e) { }
  }

  next()
}
