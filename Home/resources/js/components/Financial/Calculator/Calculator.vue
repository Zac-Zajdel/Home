<template>
  <div class="container mt-5 mx-auto sm:w-3/4 md:w-3/4 lg:w-3/4 xl:w-1/4">
    <div class="row">
      <div class="col text-center w-full bg-gray-300 border border-gray-700 h-12 pt-3">{{ total }}</div>
    </div>
    <div class="flex">
      <div
        @click="clear"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >AC</div>
      <div
        @click="sign"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >+/-</div>
      <div
        @click="percent"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >%</div>
      <div
        @click="divide"
        class="btn text-center w-1/4 bg-gray-600 border border-gray-700 h-12 pt-2"
      >/</div>
    </div>
    <div class="flex">
      <div
        @click="append(7)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >7</div>
      <div
        @click="append(8)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >8</div>
      <div
        @click="append(9)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >9</div>
      <div
        @click="multiply"
        class="btn text-center w-1/4 bg-gray-600 border border-gray-700 h-12 pt-2"
      >x</div>
    </div>

    <div class="flex">
      <div
        @click="append(4)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >4</div>
      <div
        @click="append(5)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >5</div>
      <div
        @click="append(6)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >6</div>
      <div
        @click="subtract"
        class="btn text-center w-1/4 bg-gray-600 border border-gray-700 h-12 pt-2"
      >-</div>
    </div>

    <div class="flex">
      <div
        @click="append(1)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >1</div>
      <div
        @click="append(2)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >2</div>
      <div
        @click="append(3)"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >3</div>
      <div
        @click="add()"
        class="btn text-center w-1/4 bg-gray-600 border border-gray-700 h-12 pt-2"
      >+</div>
    </div>

    <div class="flex">
      <div
        @click="append(0)"
        class="text-center w-1/2 bg-blue-500 border border-gray-700 h-12 pt-2"
      >0</div>
      <div
        @click="decimalPoint()"
        class="btn text-center w-1/4 bg-blue-500 border border-gray-700 h-12 pt-2"
      >.</div>
      <div
        @click="equals()"
        class="btn text-center w-1/4 bg-gray-600 border border-gray-700 h-12 pt-2"
      >=</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      previous: 0,
      total: 0,
      operator: null,
      operatorClicked: false
    };
  },
  methods: {
    clear() {
      this.total = 0;
    },
    sign() {
      this.total -= this.total * 2;
    },
    percent() {
      this.total /= 100;
    },
    append(number) {
      if (this.operatorClicked) {
        this.total = 0;
        this.operatorClicked = false;
      }

      this.total != 0 ? (this.total += "" + number) : (this.total = number);
    },
    decimalPoint() {
      let number = this.total.toString();
      if (number.indexOf(".") === -1 && number > 0) {
        this.append(".");
      }
    },
    setPrevious() {
      this.previous = this.total;
      this.total = 0;
      this.operatorClicked = true;
    },
    divide() {
      this.operator = (num1, num2) => num1 / num2;
      this.setPrevious();
    },
    multiply() {
      this.operator = (num1, num2) => num1 * num2;
      this.setPrevious();
    },
    subtract() {
      this.operator = (num1, num2) => num1 - num2;
      this.setPrevious();
    },
    add() {
      this.operator = (num1, num2) => +num1 + +num2;
      this.setPrevious();
    },
    equals() {
      if (!this.operator) return;
      this.total = this.operator(this.previous, this.total);
      this.previous = null;
    }
  }
};
</script>

<style scoped>
.btn {
  cursor: pointer;
}
</style>
