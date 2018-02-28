<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="did">
                {{form.did}}
            </el-form-item>
            <el-form-item label="方向名称" prop="dname">
                <el-input v-model="form.dname"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    export default {
        name:'dirUpdate',
        data(){
           return{
               form:{
                   did:'',
                   dname:'',
               },
               rules:{
                   dname:[
                       {required: true, message: '请输入方向名', trigger: 'blur'},
                       {min: 1, max: 20, message: '长度在 1 到 20 个字符', trigger: 'blur'}
                   ]
               }
           }
        },
        methods:{
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/direction/dirUpdate.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('manageDir')
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
            this.$http.post('/home/direction/dirQuery.php',this.$route.query).then(res=>{
                this.form = res.body;
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