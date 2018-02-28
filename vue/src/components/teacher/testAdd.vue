<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="background: rgba(255,255,255,0.4);padding:40px 30px">
            <el-form-item label="阶段" prop="sid">
                <el-select v-model="form.sid" placeholder="请选择阶段">
                    <el-option v-for="v in stage" :value="v.sid" :key="v.sid" :label="v.sname"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="类型" prop="type">
                <el-select v-model="form.type" placeholder="请选择类型">
                    <el-option v-for="v in type" :value="v.id" :key="v.id" :label="v.name"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="题目" prop="title">
                <el-input type="textarea" v-model="form.title" placeholder="题目中请勿出现 _  :及| 特殊符号"></el-input>
                <span class="el-form-item__error">*请以这种格式输入：这是题目_A:选项一|B:选项二(简答题写为：这是题目_)</span>
            </el-form-item>
            <el-form-item label="答案" prop="answer">
                <el-input type="textarea" v-model="form.answer" placeholder="请输入答案"></el-input>
            </el-form-item>
            <el-form-item label="解析" prop="exp">
                <el-input type="textarea" v-model="form.exp" placeholder="请输入解析"></el-input>
            </el-form-item>
            <el-form-item label="分值" prop="score">
                <el-input v-model="form.score" placeholder="请输入分值"></el-input>
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
                   sid:'',
                   type:'',
                   title:'',
                   answer:'',
                   exp:'',
                   score:'',
               },
               rules:{
                   sid:[
                       {required: true, message: '请选择阶段', trigger: 'change'},
                   ],
                   type:[
                       {required: true, message: '请选择类型', trigger: 'change'},
                   ],
                   title:[
                       {required: true, message: '请输入题干', trigger: 'blur'},
                   ],
                   answer:[
                       {required: true, message: '请输入答案', trigger: 'blur'},
                   ] ,
                   exp:[
                       {required: true, message: '请输入解析', trigger: 'blur'},
                   ],
                   score:[
                       {required: true, message: '请输入分值', trigger: 'blur'},
                   ]
               },
               stage:[],
               type:[],
           }
        },
        methods:{
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/test/testAdd.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$router.push('teacherTest')
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
            this.$http.post('/home/stage/manageStage.php').then(res=>{
                this.stage=res.body;
            }),
            this.$http.post('/home/test/teacherType.php').then(res=>{
                this.type=res.body;
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