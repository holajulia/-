from collections import Counter
import requests
import re
import networkx as nx
import matplotlib.pyplot as plt

def GET_TEXT(url):
    return requests.get(url).text

def COUNT_NAMES(text):
    names = re.findall(r"\b[A-ZА-Я]\w*", text)
    return Counter(names)

def count_double_words(text):

    double_words = re.findall(r'(\b(\w+)(?:,?\s*|-|)+\2\b)', text, re.IGNORECASE)
    double_words = [x[0] for x in double_words]
    return Counter(double_words)

def get_all_words(text):
    return re.findall(r'\b\w+\b', text)

def pairwise(sequence):
    iterable = iter(sequence)
    prev = next(iterable)
    for elem in iterable:
        yield (prev, elem)
        prev = elem

def count_alliterations(text):
    return Counter(x[0] for x in re.findall(r'(\b(\w+)\w*\b\W\b\2\w*\b)',text, re.IGNORECASE))

def count_word_pairs(text):
    return Counter(pairwise(map(lambda x: x.lower(), get_all_words(text))))

turgenev = """
Нас двое в комнате: собака моя и я. На дворе воет страшная, неистовая буря.
Собака сидит передо мною – и смотрит мне прямо в глаза.
И я тоже гляжу ей в глаза.
Она словно хочет сказать мне что то. Она немая, она без слов, она сама себя не понимает – но я ее понимаю.
Я понимаю, что в это мгновенье и в ней и во мне живет одно и то же чувство, что между нами нет никакой разницы. Мы торжественны; в каждом из нас горит и светится тот же трепетный огонек.
Смерть налетит, махнет на него своим холодным широким крылом…
И конец!
Кто потом разберет, какой именно в каждом из нас горел огонек?
Нет! это не животное и не человек меняются взглядами…
Это две пары одинаковых глаз устремлены друг на друга.
И в каждой из этих пар, в животном и в человеке – одна и та же жизнь жмется пугливо к другой.
"""

if __name__ == '__main__':
    print(GET_TEXT('http://example.com'))
    print(COUNT_NAMES("Али Баба Али. Ali Baba Санкт-Петербург ывы Фежо."))
    print(count_double_words("Еще еще бы-бы.Чуть, чуть два,два"))
    print(count_alliterations("\"Простой пример\", Давай другой пора уходя уходи"))
    print(count_word_pairs(turgenev))
    print(count_word_pairs(turgenev).keys())

graph = nx.Graph()
graph.add_edges_from(count_word_pairs(turgenev).keys())
nx.draw(graph, with_labels=True, node_size=50)
plt.show()
    
    
