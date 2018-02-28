<template>
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 修改密码</strong></div>
        <el-form :model="form" status-icon :rules="rules" ref="form" label-width="100px" class="demo-ruleForm">
            <div class="padding"></div>
            <el-form-item label="原密码" >
                <el-input type="password" v-model="form.pass"  placeholder="请输入原密码"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="newPass">
                <el-input type="password" v-model="form.newPass" auto-complete="off"  placeholder="请输入新密码"></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="checkPass">
                <el-input type="password" v-model="form.checkPass" auto-complete="off"  placeholder="请确认密码"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    export default {
        data() {
            let validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                } else {
                    if (this.form.checkPass !== '') {
                        this.$refs.form.validateField('checkPass');
                    }
                    callback();
                }
            };
            let validatePass2 = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请再次输入密码'));
                } else if (value !== this.form.newPass) {
                    callback(new Error('两次输入密码不一致!'));
                } else {
                    callback();
                }
            };
            return {
                form: {
                    newPass: '',
                    checkPass: '',
                    pass: ''
                },
                rules: {
                    newPass: [
                        { validator: validatePass, trigger: 'blur' }
                    ],
                    checkPass: [
                        { validator: validatePass2, trigger: 'blur' }
                    ],
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/test/checkPass.php',this.form).then(res=>{
                           if(res.body==1){
                               this.$message({
                                   showClose: true,
                                   message: '原密码错误',
                                   type: 'warning'
                               });
                           }else if(res.body==2){
                               this.$router.push('/')
                               this.$message({
                                   showClose: true,
                                   message: '修改成功',
                                   type: 'success'
                               });
                           }else if (res.body==3){
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
            },
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