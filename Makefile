# Number of iterations.
ITERATIONS = 50000000

run_experiment_namespace_functions:
	@echo "Running with_use.php"
	@$(MAKE) -s DIRS=experiments/namespace_functions FILENAME=with_use run_experiment
	sleep 1
	@echo "Running without_use.php"
	@$(MAKE) -s DIRS=experiments/namespace_functions FILENAME=without_use run_experiment

run_experiment_objects_vs_arrays:
	@echo "Running objects.php"
	@$(MAKE) -s DIRS=experiments/objects_vs_arrays FILENAME=objects run_experiment
	@echo "Running objects_type_hinted.php"
	sleep 1
	@$(MAKE) -s DIRS=experiments/objects_vs_arrays FILENAME=objects_type_hinted run_experiment
	sleep 1
	@echo "Running array.php"
	@$(MAKE) -s DIRS=experiments/objects_vs_arrays FILENAME=array run_experiment

run_experiment_concatenation:
	@echo "Running inline.php"
	@$(MAKE) -s DIRS=experiments/concatenation_strategies FILENAME=inline run_experiment
	sleep 1
	@echo "Running concat.php"
	@$(MAKE) -s DIRS=experiments/concatenation_strategies FILENAME=concat run_experiment
	sleep 1
	@echo "Running sprintf.php"
	@$(MAKE) -s DIRS=experiments/concatenation_strategies FILENAME=sprintf run_experiment
	sleep 1
	@echo "Running array.php"
	@$(MAKE) -s DIRS=experiments/concatenation_strategies FILENAME=array run_experiment

run_experiment_sleep:
	@$(MAKE) -s DIRS=experiments/ FILENAME=sleep run_experiment


run_experiment:
	./bin/procrec -i 10 -g --output ./$(DIRS)/plot_$(FILENAME).png php $(DIRS)/$(FILENAME).php ${ITERATIONS}

all:
	@$(MAKE) -s run_experiment_sleep
	sleep 1
	@$(MAKE) -s run_experiment_concatenation
	sleep 1
	@$(MAKE) -s run_experiment_objects_vs_arrays
	sleep 1
	@$(MAKE) -s run_experiment_namespace_functions
	sleep 1
	php ./site_generator/generate.php

buildprocrec:
	cargo install --path ./procrec
	cp /root/.cargo/bin/procrec ./bin/procrec
