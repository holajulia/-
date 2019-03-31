from collections import Counter
from nltk import *
import matplotlib.pyplot as plot
 
def get_persons(tree):
    persons = []
    if hasattr(tree, 'label'):
        if tree.label() == 'PERSON':
            
            persons.append(' '.join(subtree[0] for subtree in tree))
        else:
            for subtree in tree:
                
                persons.extend(get_persons(subtree))
    return persons
       
text = corpus.gutenberg.raw('carroll-alice.txt')
words = word_tokenize(text)
tags = pos_tag(words)
 
pos_stat = dict(Counter(word[1] for word in tags))
pos_stat = {'Nouns': pos_stat.get('NN')+pos_stat.get('NNS')+pos_stat.get('NNP'),
        'Pronouns': pos_stat.get('PRP')+pos_stat.get('PRP$')+pos_stat.get('WP'),
        'Preposition or subordinating conjunction': pos_stat.get('IN'),      
        'Adverbs': pos_stat.get('RB'),
        'Adjectives': pos_stat.get('JJ'),
        'Verbs': pos_stat.get('VB')+pos_stat.get('VBZ')+pos_stat.get('VBP')+pos_stat.get('VBG')+pos_stat.get('VBD')+pos_stat.get('VBN'),
        'Determiners':pos_stat.get('DT'),
        'Conjunction, coordinating':pos_stat.get('CC'),
        'To':pos_stat.get('TO'),
        'Particle':pos_stat.get('RP'),
        'Closing quotation marks':pos_stat.get("''"),
        'Modal auxiliary':pos_stat.get('MD'),
        'Genitive marker':pos_stat.get('POS'),
        'Numerals, cardinals':pos_stat.get('CD'),
        'Existential there':pos_stat.get('EX'),
        'Interjections':pos_stat.get('UH')
}
 

pos_stat = [(k, v/sum(pos_stat.values())) for k, v in pos_stat.items()]

pos_stat = sorted(pos_stat, key = lambda i:i[1], reverse=True)
 

persons = dict(Counter(get_persons(ne_chunk(tags))))

persons = sorted(persons.items(), key = lambda i:i[1], reverse=True)
 
print('Доли частей речи:', pos_stat)  
print('\nПерсонажи:', persons)
 
plot.title('Части речи')

plot.pie([x[1] for x in pos_stat], autopct = '%.5f')
plot.legend(labels = [x[0] for x in pos_stat])
plot.savefig('pos.png')
plot.clf()
 
plot.title('Персонажи:')
plot.pie([x[1] for x in persons], labels=None)
plot.legend(persons, loc='best')
plot.savefig('persons.png', bbox_inches='tight')
