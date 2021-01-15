function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', redirect: { name: 'login' } },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/users', name: 'users', component: page('settings/users.vue') },
  { path: '/dashboard', name: 'dashboard', component: page('general/dashboard.vue') },
  // Custom Projects Routes
  { path: '/customproject', name: 'customproject', component: page('project/index.vue') },
  { path: '/customproject/add', name: 'customproject.add', component: page('project/add.vue') },
  { path: '/customproject/edit/:id', name: 'customproject.edit', component: page('project/edit.vue') },
  { path: '/customproject/view/:id', name: 'customproject.view', component: page('project/view.vue') },
  // Donation Section Routes
  { path: '/donations', name: 'donations', component: page('donation/index.vue') },
  { path: '/donation/add', name: 'donation.add', component: page('donation/add.vue') },
  { path: '/donation/edit/:id', name: 'donation.edit', component: page('donation/edit.vue') },
  { path: '/donation/view/:id', name: 'donation.view', component: page('donation/view.vue') },
    
  // Sponsorship Section Routes
  { path: '/sponsorships/hafiz', name: 'sponsorships.hafiz', component: page('sponsorships/hafiz/index.vue') },
  { path: '/sponsorships/hafiz/add', name: 'sponsorships.hafiz.add', component: page('sponsorships/hafiz/add.vue') },
  { path: '/sponsorships/hafiz/view/:id', name: 'sponsorships.hafiz.view', component: page('sponsorships/hafiz/view.vue') },
  { path: '/sponsorships/hafiz/edit/:id', name: 'sponsorships.hafiz.edit', component: page('sponsorships/hafiz/edit.vue') },
  { path: '/sponsorships/scholars', name: 'sponsorships.scholar', component: page('sponsorships/scholar/index.vue') },
  { path: '/sponsorships/scholars/add', name: 'sponsorships.scholar.add', component: page('sponsorships/scholar/add.vue') },
  { path: '/sponsorships/scholars/view/:id', name: 'sponsorships.scholar.view', component: page('sponsorships/scholar/view.vue') },
  { path: '/sponsorships/sponsor/:id', name: 'sponsorships.sponsorships.sponsor', component: page('sponsorships/sponsorships/sponsor.vue') },
  
  // Gift Aid Section Routes
  { path: '/gift-aids', name: 'gift_aids', component: page('giftaid/index.vue') },
  { path: '/gift-aids-submitted', name: 'gift_aids_submitted', component: page('giftaid/submitted.vue') },
  { path: '/gift-aids-claimed', name: 'gift_aids_claimed', component: page('giftaid/claimed.vue') },
  { path: '/gift-aids-reports', name: 'gift_aids_reports', component: page('giftaid/reports.vue') },
  { path: '/gift-aids-reports/details/:id', name: 'gift_aids_reports_details', component: page('giftaid/details.vue') },
  
  // Reporting Section Routes
  
  // General Section Routes
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'options', name: 'settings.options', component: page('settings/option.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') },
      { path: 'roles', name: 'settings.roles', component: page('settings/role/role.vue') },
      { path: 'role/add', name: 'settings.role.add', component: page('settings/role/add.vue') },
      { path: 'permissions', name: 'settings.permissions', component: page('settings/permission/permission.vue') },
      { path: 'permission/add', name: 'settings.permission.add', component: page('settings/permission/add.vue') },
      { path: 'permission/assign/:record_id', name: 'settings.permission.assign', component: page('settings/permission/assign.vue') },
      { path: 'user/add', name: 'settings.user.add', component: page('settings/user/add.vue') },
      { path: 'user/edit/:record_id', name: 'settings.user.edit', component: page('settings/user/edit.vue') },
    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
