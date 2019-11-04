DIR:=wg-suche-joomla
prepare-upload:
	rm -rf $(DIR)
	mkdir -p $(DIR)
	cp -r server $(DIR)
	cp -r client/build $(DIR)
