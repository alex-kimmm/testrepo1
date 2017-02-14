
import string
import random

letters = ["a", "b", "c", "d","e", "f", "g", "h", "i", "j", "k", "l"]

def get_random_name(letters, length):
    return ''.join(random.choice(letters) for i in range(length))

def generate_random_name(nb, length):
    return ['test_' + get_random_name(letters, length) for i in range(nb)]

def main():
    arg = generate_random_name(1, 5)
    print(arg)
    return arg

if __name__ == "__main__":
    main()
