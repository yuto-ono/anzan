<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p class="score">Score {{ score }}</p>
                    <p v-if="mode == 'show'" class="number" :class="{ '-hidden': hidden }">{{ number }}</p>
                    <form v-else class="input-panel" action="" @submit.prevent="onSubmit">
                        <div class="form-group">
                            <label for="answer">答えを入力してください（半角数字）</label>
                            <input type="tel" class="form-control" ref="answer" v-model.number="answer">
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-block">決定</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    data() {
        return {
            mode: 'show',
            score: 0,
            number: 0,
            answer: '',
            hidden: true,
            index: 0,
            interval: 500,
            numbers: [
                15, 32, 54
            ]
        };
    },

    created() {
        const option = document.getElementById('play_option');
        if (option) {
            this.number = option.innerHTML;
        }
    },

    mounted() {
        setTimeout(() => this.showNextNumber(), 1000);
    },

    methods: {
        showNextNumber() {
            this.hidden = false;
            this.number = this.numbers[ this.index++ ];
            setTimeout(() => this.hideNumber(), this.interval);
        },

        hideNumber() {
            this.hidden = true;
            if (this.index < this.numbers.length) {
                setTimeout(() => this.showNextNumber(), this.interval);
            }
            else {
                setTimeout(() => this.toInputMode(), this.interval);
            }
        },

        toInputMode() {
            this.mode = 'input';
            setTimeout(() => this.$refs.answer.focus(), 0);
        },

        onSubmit() {
            alert('a')
        }
    }
}
</script>

<style lang="scss" scoped>

.score {
    padding: 0.5rem 1rem 0;
    font-size: 1.25rem;
}

.number {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 10rem;
    font-size: 5rem;
    text-align: center;

    &.-hidden {
        visibility: hidden;
    }
}

.input-panel {
    width: 400px;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    padding: 1rem;
}
</style>
