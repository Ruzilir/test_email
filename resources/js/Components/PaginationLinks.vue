<script setup>

defineProps({
    paginator: Object,
});

const makeLabel = (label) => {
  if (label.includes("Previous")) {
    return "<<";
  } else if (label.includes("Next")) {
    return ">>";
  } else {
    return label;
  }
};
</script>

<template>
    <div class="paginator">
        <div class="paginator-num">
            <div v-for="(link, i) in paginator.links" :key="i">
                <component
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="makeLabel(link.label)"
                    class="paginator-component"
                    :class="{
                        'paginator-link': link.url,
                        'paginator-nolink': !link.url,
                        'paginator-link-active': link.active,
                    }"
                />
            </div>
        </div>

        <p class="text-to-from">
            Показано с {{ paginator.from }} по {{ paginator.to }} из
            {{ paginator.total }} результатов
        </p>
    </div>
</template>

<style lang="scss">
.paginator {
    display: flex;
    justify-content: space-between;
    align-items: start;

    margin-top: 30px;

    @media only screen and (max-width: 480px) {
        margin-top: 20px;
        display: block;
        font-size: 18px;
    }
}

.paginator-num {
    display: flex;
    align-items: center;
    overflow: hidden;

    border-radius: 15px;

    border: 2px solid #d9d9d9;
    box-shadow: 5px 10px 15px 0 #c9c9c9;

    a {
        color: #757575;
        font-weight: 700;
    }

    
    @media only screen and (max-width: 480px) {
        justify-content: space-between;

    }
}

.paginator-component {
    display: grid;
    justify-items: center;
    align-items: center; 

    width: 40px;
    height: 40px;

    margin: 7px;
    border: 2px solid #d9d9d9;
    border-radius: 15px;

    @media only screen and (max-width: 480px) {
        margin: 3px;

        width: 33px;
        height: 33px;
    }
}

.paginator-link {
    
    &:hover {
        background-color: #76adcf;
    }
}

.paginator-nolink {
    background-color: #b4b4b4;
}

.paginator-link-active {
    background-color: #76adcf;
}

.text-to-from {
    font-size: 24px;
    font-weight: 600;

    @media only screen and (max-width: 480px) {
        font-size: 18px;
        font-weight: 500;
        text-align: center;
        margin-top: 20px;
    }
}
</style>