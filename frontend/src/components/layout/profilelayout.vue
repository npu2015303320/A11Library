<template>
<div>
  <div class="skin-blue">
    <!-- Main Header -->
    <topbar></topbar>
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
          <div class="pull-left image">
            <div v-if="user.imageid == 0">
              <img :src="logo" width="60px" height ="60px" class="img-circle" alt="User Image">
            </div>
            <div v-else>
              <img :src="ImageUrl" width="60px" height ="60px" class="img-circle" alt="User Image">
            </div>
          </div>
          <div class="pull-left info">
              <p>name:{{user.name}}</p>
              <p>useruniversity:{{user.useruniversity}}</p>
              <!-- Status -->
          </div>
          </div>
          <!-- search form (Optional) -->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Profile Center</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="#/profile/myinfo"><i class="fa fa-link"></i> <span>My Information</span></a></li>
            <li><a href="#/profile/resetuserImage"><i class="fa fa-link"></i> <span>Reset Image</span></a></li>
            <li><a href="#/profile/resetpassword"><i class="fa fa-link"></i> <span>Reset Password</span></a></li>
            <li><a href="#/profile/resetusercode"><i class="fa fa-link"></i> <span>Reset User Code</span></a></li>
          </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <router-view></router-view>
    </div>
  </div>
</div>

</template>
<script>
import '@/assets/js/adminlte.min.js'
import logo from '@/assets/img/user2-160x160.jpg'
import topbar from '@/components/vue/topbar.vue'
import axios from 'axios'
export default {
    data() {
      return {
        logo: logo,
        role: 0,
        user: '',
        ImageUrl: ''
      }
    },
    methods: {
      shutmenu:function() {
        $('[data-toggle="push-menu"]').pushMenu('toggle');
      }
    },
    async created () {
        var res = await axios.get('/api/auth/admininfo');
        console.log(res.data);
        this.user = res.data
        this.ImageUrl = `/api/getImage?ImageId=` + this.user.imageid
    },
    components: {
      topbar
    }
}    
</script>