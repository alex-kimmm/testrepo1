import random
domains = ["test-domain-1.com", "test-domain-2.com", "test-domain-3.com", "test-domain-4.com", "test-domain-5.com"]
letters = ["a", "b", "c", "d","e", "f", "g", "h", "i", "j", "k", "l"]

def get_random_domain(domains):
    return random.choice(domains)

def get_random_name(letters, length):
    return ''.join(random.choice(letters) for i in range(length))

def generate_random_emails(nb, length):
    return ['test_' + get_random_name(letters, length) + '@' + get_random_domain(domains) for i in range(nb)]

def main():
    arg = generate_random_emails(1, 5)
    print(arg)
    return arg

if __name__ == "__main__":
    main()
