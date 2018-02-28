<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="班级名称" prop="cname">
                <el-input v-model="form.cname"></el-input>
            </el-form-item>
            <el-form-item label="所处阶段" prop="sid">
                <el-select v-model="form.sid" placeholder="请选择所处阶段">
                    <el-option v-for="v in stage" :value="v.sid" :key="v.sid" :label="v.sname"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="所属方向" prop="did">
                <el-select v-model="form.did" placeholder="请选择所属方向">
                    <el-option v-for="v in direction" :value="v.did" :key="v.did" :label="v.dname"></el-option>
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
        name:'classesAdd',
        data(){
           return{
               form:{
                   cname:'',
                   did:'',
                   sid:''
               },
               rules:{
                   cname:[
                       {required: true, message: '请输入阶段名称', trigger: 'blur'},
                       {min: 1, max: 20, message: '长度在 1 到 20 个字符', trigger: 'blur'}
                   ],
                   did: [
                       { required: true, message: '请选择所属方向', trigger: 'change' }
                   ],
                   sid: [
                       { required: true, message: '请选择所处阶段', trigger: 'change' }
                   ],
               },
               direction:[],
               stage:[]
           }
        },
        methods:{
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/classes/classesAdd.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('manageClasses')
                            }else if(res.body=='error'){
                                this.$message({
                                    showClose: true,
                                    message: '添加失败',
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
            this.$http.post('/home/direction/manageDir.php',this.$route.query).then(res=>{
                this.direction = res.body;
            })
            this.$http.post('/home/stage/manageStage.php',this.$route.query).then(res=>{
                this.stage = res.body;
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