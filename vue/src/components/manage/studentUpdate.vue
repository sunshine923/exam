<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="uid">
                {{form.uid}}
            </el-form-item>
            <el-form-item label="名字" prop="user">
                <el-input v-model="form.user"></el-input>
            </el-form-item>
            <el-form-item label="班级" prop="cname">
                <el-select v-model="form.cname" :placeholder="form.cname">
                    <el-option v-for="v in classes" :value="v.cname" :key="v.cid" :label="v.cname"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    export default {
        name:'studentUpdate',
        data(){
           return{
               form:{
                   uid:'',
                   user:'',
                   cname:''
               },
               classes:[],
               rules:{
                   user:[
                       {required: true, message: '请输入方向名', trigger: 'blur'},
                       {min: 1, max: 20, message: '长度在 1 到 20 个字符', trigger: 'blur'}
                   ],
                   cname: [
                       { required: true, message: '请选择班级', trigger: 'change' }
                   ],
               }
           }
        },
        methods:{
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/student/studentUpdate.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('manageStudent')
                            }else if(res.body=='error'){
                                this.$message({
                                    showClose: true,
                                    message: '修改失败',
                                    type: 'warning'
                                });
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            }
        },
        mounted(){
            this.$http.post('/home/student/studentQuery.php',this.$route.query).then(res=>{
                this.form = res.body[1]
                this.classes = res.body[0];
            })
        },
        beforeCreate(){
            if(!localStorage.admin){
                this.$message({
                    showClose: true,
                    message: '请先登录',
                    type: 'warning'
                });
                this.$router.push({name:'login'})
            }
        }
    }
</script>
<style>

</style>