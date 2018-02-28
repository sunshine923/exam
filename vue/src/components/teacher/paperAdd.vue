<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="班级" prop="cname">
                <el-select v-model="form.cid" placeholder="请选择班级">
                    <el-option v-for="v in classes" :value="v.cid" :key="v.cid" :label="v.cname"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="试卷名称" prop="pname">
                <el-input v-model="form.pname" placeholder="请输入试卷名称"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    export default {
        name:'dirAdd',
        data(){
           return{
               form:{
                   cid:'',
                   pname:'',
               },
               rules:{
                   cid:[
                       {required: true, message: '请选择阶段', trigger: 'change'},
                   ],
                   pname:[
                       {required: true, message: '请输入题干', trigger: 'blur'},
                   ],
               },
               classes:[],
           }
        },
        methods:{
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/test/paperAdd.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('teacherPaper')
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
            this.$http.post('/home/classes/manageClasses.php').then(res=>{
                this.classes=res.body;
            })
        },
        beforeCreate(){
            if(!localStorage.teacher){
                this.$message({
                    showClose: true,
                    message: '请先登录',
                    type: 'warning'
                });
                this.$router.push({name:'login'})
            }
        },
    }
</script>
<style>

</style>