import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'
import login from '../components/login/login.vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

Vue.use(ElementUI)

//管理员
import manage from '../components/manage/manage.vue'

import manageDir from '../components/manage/manageDir.vue'
import dirUpdate from '../components/manage/dirUpdate.vue'
import dirAdd from '../components/manage/dirAdd.vue'

import manageStage from '../components/manage/manageStage.vue'
import stageUpdate from '../components/manage/stageUpdate.vue'
import stageAdd from '../components/manage/stageAdd.vue'

import manageClasses from '../components/manage/manageClasses.vue'
import classesUpdate from '../components/manage/classesUpdate.vue'
import classesAdd from '../components/manage/classesAdd.vue'

import manageStudent from '../components/manage/manageStudent.vue'
import studentUpdate from '../components/manage/studentUpdate.vue'
import studentAdd from '../components/manage/studentAdd.vue'

import manageTeacher from '../components/manage/manageTeacher.vue'
import teacherUpdate from '../components/manage/teacherUpdate.vue'
import teacherAdd from '../components/manage/teacherAdd.vue'

//teacher
import teacher from '../components/teacher/teacher.vue'
import teacherTest from '../components/teacher/teacherTest.vue'
import testAdd from '../components/teacher/testAdd.vue'
import testUpdate from '../components/teacher/testUpdate.vue'


import teacherType from '../components/teacher/teacherType.vue'
import typeAdd from '../components/teacher/typeAdd.vue'
import typeUpdate from '../components/teacher/typeUpdate.vue'

import teacherPass from '../components/teacher/teacherPass.vue'

import teacherPaper from '../components/teacher/teacherPaper.vue'
import paperAdd from '../components/teacher/paperAdd.vue'
import paperUpdate from '../components/teacher/paperUpdate.vue'

import teacherText from '../components/teacher/teacherText.vue'

///////student
import student from '../components/student/student.vue'
import studentExam from '../components/student/studentExam.vue'
import studentPaper from '../components/student/studentPaper.vue'
import studentRecord from '../components/student/studentRecord.vue'
import studentAnswer from '../components/student/studentAnswer.vue'



Vue.use(Router)
Vue.use(VueResource)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'login',
      component: login
    },
   {
     path:'/manage',
     name:'manage',
     component:manage,
     children:[
         {
           path:'manageDir',
           name:'manageDir',
           component: manageDir
         },
         {
             path:'dirUpdate',
             name:'dirUpdate',
             component: dirUpdate
         },
         {
             path:'dirAdd',
             name:'dirAdd',
             component: dirAdd
         },
         {
             path:'manageStage',
             name:'manageStage',
             component: manageStage
         },
         {
             path:'stageUpdate',
             name:'stageUpdate',
             component: stageUpdate
         },
        {
             path:'stageAdd',
             name:'stageAdd',
             component: stageAdd
        },
        {
             path:'manageClasses',
             name:'manageClasses',
             component: manageClasses
        },
        {
            path:'classesUpdate',
            name:'classesUpdate',
            component: classesUpdate
        },
        {
            path:'classesAdd',
            name:'classesAdd',
            component: classesAdd
        },
       {
           path:'manageStudent',
           name:'manageStudent',
           component: manageStudent
       },
       {
           path:'studentUpdate',
           name:'studentUpdate',
           component: studentUpdate
       },
       {
           path:'studentAdd',
           name:'studentAdd',
           component: studentAdd
       },
       {
           path:'manageTeacher',
           name:'manageTeacher',
           component: manageTeacher
       },
       {
           path:'teacherUpdate',
           name:'teacherUpdate',
           component: teacherUpdate
       },
       {
           path:'teacherAdd',
           name:'teacherAdd',
           component: teacherAdd
       },
     ]
   },
   {
      path: '/teacher',
      name: 'teacher',
      component: teacher,
      children:[
          {
              path:'teacherTest',
              name:'teacherTest',
              component:teacherTest
          },
          {
              path:'testAdd',
              name:'testAdd',
              component:testAdd
          },
          {
              path:'testUpdate',
              name:'testUpdate',
              component:testUpdate
          },
          {
              path:'teacherPass',
              name:'teacherPass',
              component:teacherPass
          },
          {
              path:'teacherType',
              name:'teacherType',
              component:teacherType
          },
          {
              path:'typeAdd',
              name:'typeAdd',
              component:typeAdd
          },
          {
              path:'typeUpdate',
              name:'typeUpdate',
              component:typeUpdate
          },
          {
              path:'teacherPaper',
              name:'teacherPaper',
              component:teacherPaper
          },
          {
              path:'paperAdd',
              name:'paperAdd',
              component:paperAdd
          },
          {
              path:'paperUpdate',
              name:'paperUpdate',
              component:paperUpdate
          },
          {
              path:'teacherText',
              name:'teacherText',
              component:teacherText
          },
      ]
      },
   {
          path: '/student',
          name: 'student',
          component: student,
          children:[
              {
                  path:'studentExam',
                  name:'studentExam',
                  component:studentExam
              },
              {
                  path:'studentPaper',
                  name:'studentPaper',
                  component:studentPaper
              },
              {
                  path:'studentRecord',
                  name:'studentRecord',
                  component:studentRecord
              },
              {
                  path:'studentAnswer',
                  name:'studentAnswer',
                  component:studentAnswer
              }
           ]


      },
  ]
})
