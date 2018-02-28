<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="sid">
                {{form.sid}}
            </el-form-item>
            <el-form-item label="阶段名称" prop="sname">
                <el-input v-model="form.sname"></el-input>
            </el-form-item>
            <el-form-item label="所属方向">
                <el-select v-model="form.did" >
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
        name:'stageUpdate',
        data(){
           return{
               form:{
                   sid:'',
                   sname:'',
                   did:''
               },
               direction:[],
               rules:{
                   sname:[
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
                        this.$http.post('/home/stage/stageUpdate.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('manageStage')
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
            this.$http.post('/home/stage/stageQuery.php',this.$route.query).then(res=>{
                this.form = res.body[1]
                this.direction = res.body[0];
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