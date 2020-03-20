<?php

$dir = $_ENV['WORK_DIR'];
$todo = "$dir/.todo2";

if (preg_match('/favicon\.ico/', $_SERVER['REQUEST_URI'])) {
    header("Location: https://i.imgur.com/eCDPzLa.png");
    exit(0);
}

if ($final = $_POST['final'] ?? '')
    exit(file_put_contents($todo, "{\"tasks\": $final}"));

if (!file_exists($todo))
    file_put_contents($todo, '{"tasks": []}');

$tasks = json_decode(file_get_contents($todo), TRUE);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= ucfirst(basename($dir)) ?>: Todo</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <style>
        label.task a {
            visibility: hidden
        }

        label.task:hover a {
            visibility: visible
        }

        .panel {
            margin-top: 15px;
            min-width: 50%;
            max-height: calc(100vh - 125px);
            overflow: auto;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">

<div id="app" class="container">
    <div class="row">
        <div v-for="type in ['Pending', 'Completed']" class="col panel" :style="{opacity: type === 'Completed' ? 0.45 : 1}">
            <div><input type="search" v-model.trim="search[type]" :placeholder="type + ' &#x1F50D;'" style="font-size: 24px; border: 0;"></div>
            <draggable v-model="tasks">
                <div v-for="(task, i) in tasks" :key="task.text" v-if="(type === 'Pending' && !task.completion) || (type === 'Completed' && task.completion)"
                     v-show="!search[type] || (task.text.indexOf(search[type]) !== -1)">
                    <label class="task">
                        <input type="checkbox" v-model="task.completion"> <span :title="timeSince(task) + ' ago'">{{task.text}}</span>
                        <a href="#" @click.prevent="tasks.splice(i, 1)">&#128465;</a>
                    </label>
                </div>
            </draggable>
        </div>
    </div>
    <form class="row" style="margin-top: 30px;" @submit.prevent="addTask()">
        <input type="text" placeholder="New task" v-model.trim="task" style="margin-right: 5px;">
        <input class="button-primary" type="submit" value="Add">
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.min.css" integrity="sha256-Ro/wP8uUi8LR71kwIdilf78atpu8bTEwrK5ZotZo+Zc=" crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sortablejs@1.4.2"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>

<script>

    new Vue({
        el: '#app',
        data() {
            return {search: {}, task: '', tasks: <?=json_encode($tasks['tasks'])?>}
        },
        methods: {
            now() {
                return Math.floor(+(new Date()) / 1000);
            },
            addTask() {
                if (this.task !== '')
                    this.tasks.push({"text": this.task, "priority": "medium", "creation": this.now()});

                this.task = '';
            },
            timeSince(task) {
                var date = task.completion > 0 ? task.completion * 1000 : task.creation * 1000;
                var seconds = Math.floor((new Date() - date) / 1000);
                var interval = Math.floor(seconds / 31536000);

                if (interval >= 1) {
                    return interval + " years";
                }
                interval = Math.floor(seconds / 2592000);
                if (interval >= 1) {
                    return interval + " months";
                }
                interval = Math.floor(seconds / 86400);
                if (interval >= 1) {
                    return interval + " days";
                }
                interval = Math.floor(seconds / 3600);
                if (interval >= 1) {
                    return interval + " hours";
                }
                interval = Math.floor(seconds / 60);
                if (interval >= 1) {
                    return interval + " minutes";
                }
                return Math.floor(seconds) + " seconds";
            }
        },
        watch: {
            tasks: {
                deep: 'true',
                handler(v) {
                    let tasks = JSON.parse(JSON.stringify(v)), final = [];
                    for (let task of tasks) {
                        if (task.completion === false) delete (task.completion);
                        else if (task.completion === true) task.completion = this.now();
                        final.push(task);
                    }

                    fetch('', {method: "POST", body: new URLSearchParams("final=" + JSON.stringify(final))})
                        .catch(e => alert("Save failed! " + e));
                }
            }
        }
    });
</script>
</body>
</html>

