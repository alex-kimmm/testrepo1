import random
from random import randint

def random_digit_generator(n):
    n = random.randint(100000, 999999)
    return n

def main():
    argum = random_digit_generator(5)
    print(argum)
    return argum

if __name__ == "__main__":
    main()
