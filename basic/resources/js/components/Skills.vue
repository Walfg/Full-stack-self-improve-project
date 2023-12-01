<template>
    <div class="container">
        <div class="card">
            <div class="card-header">Skills</div>

            <div class="card-body">
                <div class="row mb-2" v-for="(input, i) in inputs" :key="i">
                    <div class="card">
                    <div class="col-12 text-center">
                        This is element number {{ input }}
                        <textarea class="form-control mb-2" name="skills[]" v-model="inputs[i]"></textarea>
                        <button class="btn btn-danger" @click.prevent="inputs.splice(i, 1)">Delete</button>
                    </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" @click.prevent="inputs.push(inputs.length+1)">Add</button>  
        </div>
    </div>
</template>
    
<script>
export default {
    props: ["skills"],
    data() {
        return {    
            inputs: this.skills,
        }
    },  
    methods: {
        // deleteSkill(index) {
        //     // Logic to delete the skill
        //     this.inputs.splice(index, 1);
        // },
        // add(){
        //     this.inputs.push(this.inputs.length+1)
        // }
    }
}
</script>


