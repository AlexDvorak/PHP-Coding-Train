class Point {
  float x;
  float y;
  int label;

  Point() {
    x = random(width);
    y = random(height);

    if (x > y) {
      label = 1;
    } else {
      label = -1;
    }
  }

  void show() {
    stroke(0);
    if (label == 1) {
      fill(255);
    } else {
      fill(0);
    }
    ellipse(x, y, 32, 32);
  }
}
// The activation function
int sign(float n) {
  if (n >= 0) {
    return 1;
  } else {
    return -1;
  }
}


class Perceptron {
  float[] weights = new float[2];
  float lr = 0.1;

  // Constructor
  Perceptron() {
    // Initialize the weights randomly
    for (int i = 0; i < weights.length; i++) {
      weights[i] = random(-1, 1);
    }
  }

  int guess(float[] inputs) {
    float sum = 0;
    for (int i = 0; i < weights.length; i++) {
      sum += inputs[i]*weights[i];
    }
    int output = sign(sum);
    return output;
  }

  void train(float[] inputs, int target) {
    int guess = guess(inputs);
    int error = target - guess;
    // Tune all the weights
    for (int i = 0; i < weights.length; i++) {
      weights[i] += error * inputs[i] * lr;
    }
  }
}
