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

Perceptron brain;

Point[] points = new Point[100];

int trainingIndex = 0;

void setup() {
  size(800, 800);
  brain = new Perceptron();

  for (int i = 0; i < points.length; i++) {
    points[i] = new Point();
  }



  float[] inputs = {-1, 0.5};
  int guess = brain.guess(inputs);
  println(guess);
}

void draw() {
  background(255);
  stroke(0);
  line(0, 0, width, height);
  for (Point pt : points) {
    pt.show();
  }

  for (Point pt : points) {
    float[] inputs = {pt.x, pt.y};
    int target = pt.label;
    int guess = brain.guess(inputs);
    if (guess == target) {
      fill(0, 255, 0);
    } else {
      fill(255, 0, 0);
    }
    noStroke();
    ellipse(pt.x, pt.y, 16, 16);
  }

  Point training = points[trainingIndex];
  float[] inputs = {training.x, training.y};
  int target =training.label;
  brain.train(inputs, target);
  trainingIndex++;
  if (trainingIndex == points.length) {
    trainingIndex = 0;
  }
}

void mousePressed() {
  for (Point pt : points) {
  }
}
