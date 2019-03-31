#!/usr/bin/env python3

max_height = 30 # lines
column_separator = '  '

labels = []
label2value = {}
max_value = 0.0
with open('hist.txt', 'r') as f:
	for line in f:
		label, value = line.split(':')
		value = float(value)
		labels.append(label)
		label2value[label] = value
		if value > max_value:
			max_value = value

print()

label2height = {}
label2width = {}
for label in labels:
	value = label2value[label]
	height = round(value / max_value * max_height)
	label2height[label] = height
	label2width[label] = len(label)

for i_line in range(max_height):
	# i_line == 0: height=30
	# i_line == 1: height={30, 29}
	# ...
	# i_line == 29: height={30, 29, ..., 1}
	#
	# i_line: height={30, 29, ..., 30-i_line}
	for i_label in range(len(labels)):
		label = labels[i_label]

		height = label2height[label]
		if height >= 30 - i_line:
			color = 'x'
		else:
			color = ' '

		width = label2width[label]
		for pixel in range(width):
			print(color, end='')

		if i_label != len(labels) - 1: # not last column
			print(column_separator, end='')

	print()

print()

for i_label in range(len(labels)):
	label = labels[i_label]
	print(label, end='')

	if i_label != len(labels) - 1: # not last column
		print(column_separator, end='')

print()

for i_label in range(len(labels)):
	label = labels[i_label]
	value = label2value[label]
	value_str = str(value)

	column_width = label2width[label]
	value_width = len(value_str)
	if value_width > column_width:
		value_str = value_str[0:column_width] # truncate
	elif value_width < column_width:
		delta = column_width - value_width
		value_str += ' ' * delta # add spaces

	print(value_str, end='')

	if i_label != len(labels) - 1: # not last column
		print(column_separator, end='')

print()

